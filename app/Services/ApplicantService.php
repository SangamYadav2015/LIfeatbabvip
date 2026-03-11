<?php

namespace App\Services;

use App\Repositories\ApplicantRepository;
use App\Repositories\InterviewAvailabilityRepository;
use Illuminate\Support\Facades\Hash;
use App\Models\Applicant;
use App\Mail\OfferLetterMail;
use App\Mail\JoiningLetterMail;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Models\InterviewAvailability;
use App\Models\JobApplication;
use PragmaRX\Google2FAQRCode\Google2FA;

class ApplicantService
{
    protected $applicantRepository;
    protected $interviewAvailabilityRepository;


    public function __construct(ApplicantRepository $applicantRepository, InterviewAvailabilityRepository $interviewAvailabilityRepository)
    {
        $this->applicantRepository = $applicantRepository;
            $this->interviewAvailabilityRepository = $interviewAvailabilityRepository;

    }

    public function register(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        return $this->applicantRepository->create($data);
    }

    public function updateProfile($id, array $data)
    {
        return $this->applicantRepository->update($data, $id);
    }

    public function deleteProfile($id)
    {
        return $this->applicantRepository->delete($id);
    }

    public function changePassword($id, $newPassword)
    {
        $applicant = $this->applicantRepository->find($id);
        $applicant->password = Hash::make($newPassword);
        return $applicant->save();
    }

    public function createProfileImage(array $data)
    {
        return $this->applicantRepository->createProfileImage($data);
    }

    public function updateProfileImage($id, array $data)
    {
        return $this->applicantRepository->updateProfileImage($id, $data);
    }

    public function getAllApplicantsWithJobApplicationsCount()
    {
        return $this->applicantRepository->getAllApplicantsWithJobApplicationsCount();
    }

    public function updateApplicantStatus($request)
    {
        $request->validate([
            'status' => 'required|in:applied,screened,hired,pending,rejected,Shortlisted,Interview schedule,Background verification',
            'job_application_id' => 'required|exists:job_applications,id',
        ]);

        $jobApplication = JobApplication::with(['applicant', 'job'])->findOrFail($request->input('job_application_id'));
        $applicant = $jobApplication->applicant;
        $jobTitle = $jobApplication->job->title ?? $jobApplication->title ?? 'N/A';

        $offerDetails = null;
        $notificationMessage = '';
        $publicFileUrl = null;
        $offerLetterHtml = null;
        $progress = $this->getProgress($request->input('status'));

        if ($request->input('status') === 'hired') {
            $offerDetails = "We are excited to offer you the position of {$jobTitle}. The next steps will be shared shortly.";
            $offerLetterHtml = $this->generateOfferLetterHtml($applicant, $jobTitle, $offerDetails);
            $pdfFilePath = $this->generateOfferLetterPdf($offerLetterHtml, $applicant, $jobTitle);
            $this->sendOfferLetterEmail($applicant, $jobTitle, $pdfFilePath);
            $notificationMessage = "Congratulations! You have been hired for the position of {$jobTitle}.";
            $publicFileUrl = url('offer_letters/' . basename($pdfFilePath));
            $jobApplication->offer_letter_path = 'offer_letters/' . basename($pdfFilePath);
        } elseif ($request->input('status') === 'rejected') {
            $notificationMessage = "Sorry, you have not been selected for the position of {$jobTitle}.";
        } elseif ($request->input('status') === 'Interview schedule') {
            $scheduleLink = route('interview.schedule.form', ['applicant_id' => $applicant->id]);
            $notificationMessage = "Please schedule your interview for the position of {$jobTitle}.";
            $offerLetterHtml = "<p>{$notificationMessage}</p><p><a href='{$scheduleLink}'>Click here to schedule your interview</a></p>";
        }

        $jobApplication->status = $request->input('status');
        $jobApplication->progress = $progress;
        $jobApplication->save();

        $this->storeNotification($applicant, $notificationMessage, $offerLetterHtml, $publicFileUrl, $request->input('status'));

        return true;
    }

    protected function getProgress($status)
    {
        return match($status) {
            'applied' => 10,
            'pending' => 20,
            'screened' => 50,
            'Shortlisted' => 60,
            'Interview schedule' => 70,
            'Background verification' => 85,
            'hired' => 100,
            default => 0,
        };
    }

    protected function generateOfferLetterHtml($applicant, $jobTitle, $offerDetails)
    {
        return "
            <div style='font-family: Arial, sans-serif; padding: 20px; border: 1px solid #ccc; border-radius: 10px;'>
                <h2 style='color: #2d87f0;'>Offer Letter: Congratulations {$applicant->full_name}</h2>
                <p>We are excited to offer you the position of <strong>{$jobTitle}</strong>. Below are the details:</p>
                <div style='background-color: #f9f9f9; padding: 20px; border-radius: 5px; margin-bottom: 15px;'>
                    <h3 style='color: #2d87f0;'>Offer Details:</h3>
                    <p>{$offerDetails}</p>
                </div>
                <p>We look forward to having you on our team!</p>
                <footer style='margin-top: 30px;'>
                    <p>Best regards, <br> The Team</p>
                </footer>
            </div>";
    }

    protected function generateOfferLetterPdf($offerLetterHtml, $applicant, $jobTitle)
    {
        $dompdf = new Dompdf();
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $dompdf->setOptions($options);
        $dompdf->loadHtml($offerLetterHtml);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $pdfFileName = "offer_letter_{$applicant->id}_{$jobTitle}.pdf";
        $offerLettersDirectory = public_path('offer_letters');

        if (!file_exists($offerLettersDirectory)) {
            mkdir($offerLettersDirectory, 0777, true);
        }

        $filePath = $offerLettersDirectory . '/' . $pdfFileName;
        file_put_contents($filePath, $dompdf->output());

        return $filePath;
    }

    protected function sendOfferLetterEmail($applicant, $jobTitle, $pdfFilePath)
    {
        Mail::to($applicant->email)->send(new OfferLetterMail($applicant, $jobTitle, $pdfFilePath));
    }

    protected function storeNotification($applicant, $message, $offerLetterHtml, $offerLetterLink, $status)
    {
        $jobApplication = $applicant->jobApplications->first();

        \DB::table('notifications')->insert([
            'id' => (string) Str::uuid(),
            'notifiable_id' => $applicant->id,
            'notifiable_type' => Applicant::class,
            'job_id' => $jobApplication?->job_id,
            'applicant_id' => $applicant->id,
            'data' => json_encode([
                'message' => $message,
                'offer_letter_html' => $offerLetterHtml,
                'offer_letter_link' => $offerLetterLink,
            ]),
            'type' => $status,
            'link' => $offerLetterLink,
            'offer_accepted' => 0,
            'created_at' => now(),
            'updated_at' => now(),
            'read_at' => null,
        ]);
    }

    public function getNotificationWithData($id)
    {
        $notification = $this->applicantRepository->findNotificationById($id);
        $notificationData = json_decode($notification->data, true);
        $notification->update(['read_at' => now()]);

        return compact('notification', 'notificationData');
    }

    public function acceptOffer($id)
    {
        $notification = $this->applicantRepository->findNotificationById($id);

        if (!$notification) {
            Log::error("Notification with UUID $id not found.");
            return null;
        }

        if ($notification->offer_accepted == 1) {
            return 'You have already accepted the offer.';
        }

        $this->applicantRepository->updateOfferAcceptedStatus($notification, 1);

        $applicant = $this->applicantRepository->find($notification->applicant_id);
        $jobTitle = $applicant->jobApplications->first()->job->title ?? 'N/A';

        Mail::to($applicant->email)->send(new JoiningLetterMail($applicant, $jobTitle));

        return 'Offer accepted successfully. Joining letter has been sent.';
    }

    public function storeAvailability($applicantId, array $data)
    {
        return $this->interviewAvailabilityRepository->storeAvailability($applicantId, $data);
    }
    
    public function getApplicant($applicantId)
    {
        return $this->applicantRepository->find($applicantId);
    }

  
    public function deleteApplicant($applicantId)
    {
        return $this->applicantRepository->delete($applicantId);
    }
    
       public function getTotalApplicants()
    {
        return $this->applicantRepository->getTotalApplicants();
    }
        public function getApplicantByEmail($email)
    {
        return $this->applicantRepository->findByEmail($email);
    }
    
    
    public function listAllAvailability($perPage = 10)
    {
        return $this->interviewAvailabilityRepository->getCurrentMonthAvailability($perPage);
    }
    public function getJobApplicationsWithPostJob($applicantId)
    {
        return $this->applicantRepository->getJobApplicationsWithPostJob($applicantId);
    }
    
    
    public function setupTwoFactorAuth($applicantId)
    {
        return $this->applicantRepository->setupTwoFactorAuth($applicantId);
    }
    public function disableTwoFactorAuth($applicantId, $token)
    {
        return $this->applicantRepository->disableTwoFactorAuth($applicantId, $token);
    }
    
    public function verifyAndEnableTwoFactorAuth($applicantId, $token)
    {
        return $this->applicantRepository->verifyAndEnableTwoFactorAuth($applicantId, $token);
    }
    
    public function createFromSignedUrl(array $data)
    {
        $data['password'] = bcrypt($data['password']); // Ensure password is hashed
        return $this->applicantRepository->createauth($data);
    }
}
