<?php



namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Services\SettingService;

use App\Services\UserLoginAttemptServices;

use App\Services\UserService;

use App\Mail\InvalidLoginAttempt;

use Illuminate\Support\Facades\Mail;

use PragmaRX\Google2FAQRCode\Google2FA;

use Exception;
use App\Services\JobApplicationService;

use App\Services\ApplicantService;

use Illuminate\Support\Facades\Log;

use App\Models\JobApplication;

use App\Models\EducationInformation;

use App\Models\PostJob;



use App\Models\Document;

use App\Models\Applicant;



use Illuminate\Support\Facades\Storage;

use App\Models\WorkExperience;



use App\Models\PersonalInformation;

use App\Models\Notification;

use App\Models\OfferLetter;

use App\Notifications\StatusUpdated;

use Dompdf\Dompdf;

use Dompdf\Options;

use App\Mail\OfferLetterMail; 
use App\Services\VerificationService;
use App\Services\ApplicantServiceInterface;
use Illuminate\Support\Str;
use App\Mail\JoiningLetterMail;
use Carbon\Carbon;













class AdminController extends Controller

{

    protected $settingService;

    protected $userLoginAttemptServices;

    protected $userService;

   
    protected $verificationService;
    protected $jobApplicationService;
    protected $applicantService;
    public function __construct(

        SettingService $settingService,

        UserLoginAttemptServices $userLoginAttemptServices,

        UserService $userService,
      //  ApplicantServiceInterface $applicantService,
        VerificationService $verificationService,
        JobApplicationService $jobApplicationService ,
        ApplicantService $applicantService// Make sure this is injected

        
    ) {

        $this->settingService = $settingService;

        $this->userLoginAttemptServices = $userLoginAttemptServices;

        $this->userService = $userService;

        if (is_null($verificationService)) {
            Log::error("Verification Service is not properly instantiated");
        }
    
        $this->verificationService = $verificationService;
        $this->jobApplicationService = $jobApplicationService;
        $this->applicantService = $applicantService;

    }





    public function showLoginForm()

    {

        try {

            $thirdPartySetting = $this->settingService->list()->where('setting_type', 'third_party')->first();

            return view('admin.login', compact('thirdPartySetting'));

        } catch (Exception $e) {

            Log::channel('database')->error('User Login', [

                'error' => $e->getMessage(),

                'stack_trace' => $e->getTraceAsString(),

            ]);

            return response()->view('errors.500', [], 500);

        }

    }



    public function login(Request $request)

    {

        try {

            $request->validate([

                'email' => 'required|email',

                'password' => 'required',

            ]);





            $remember = $request->has('remember');



            if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {

                if (Auth::user()->status !== 1) {

                    return back()->withErrors([

                        'email' => 'Your account is inactive. Please contact admin support.',

                    ])->withInput($request->only('email', 'remember'));

                }



                if (Auth::user()->department_id !== 1  && Auth::user()->designation !== '1') {

                    $checkLastAttempt = $this->checkLastLoginAttempt(Auth::user()->email, Auth::user()->id);

                    if ($checkLastAttempt === true) {

                        return back()->withErrors([

                            'email' => 'Your Accounts is Incative Reason For Many Login Attempts. Please contact admin support.',

                        ])->withInput($request->only('email', 'remember'));

                    }

                }

                return redirect()->route('admin.dashboard');

            }



            $this->setUserLoginAttempt($request->email);

            return back()->withErrors([

                'email' => 'The provided credentials do not match our records.',

            ])->withInput($request->only('email', 'remember'));

        } catch (Exception $e) {

            Log::channel('database')->error('User Login Check', [

                'error' => $e->getMessage(),

                'stack_trace' => $e->getTraceAsString(),

            ]);

            return response()->view('errors.500', [], 500);

        }

    }



    public function checkLastLoginAttempt($email, $userId)

    {

        try {

            $siteSetting = $this->settingService->list()->where('setting_type', 'site_setting')->first();

            if ($siteSetting) {

                $decodeData = decodeData($siteSetting->setting_data);

                if (isset($decodeData['admin_number_of_login_attempt']) && $decodeData['admin_number_of_login_attempt'] !== null) {

                    $numberOfAttemptsSetting = $decodeData['admin_number_of_login_attempt'];

                    // Count the number of login attempts within the time frame

                    $numberOfAttempts = $this->userLoginAttemptServices->list()->where('email', $email)->where('status', '!=', 1)

                        ->where('user_id', $userId)

                        // ->where('created_at', '>=', $timeFrame)

                        ->count();

                    if ($numberOfAttempts >= $numberOfAttemptsSetting) {

                        return true;

                    }

                }

            }



            return false;

        } catch (Exception $e) {

            Log::channel('database')->error('User Login Attempt Check', [

                'error' => $e->getMessage(),

                'stack_trace' => $e->getTraceAsString(),

            ]);

            return response()->view('errors.500', [], 500);

        }

    }



  public function setUserLoginAttempt($email)
{
    try {
        $userQuery = $this->userService->list()->where('email', $email);
        $siteSetting = $this->settingService->list()->where('setting_type', 'site_setting')->first();
        $user = $userQuery->first();
        $userId = $user ? $user->id : null;
        $ipAddress = request()->ip() ?? '0.0.0.0';

        $dataStore = [
            'email' => $email,
            'user_id' => $userId,
            'ip_address' => $ipAddress,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $this->userLoginAttemptServices->create($dataStore);

        if ($siteSetting && $userId !== null) {
            $decodeData = decodeData($siteSetting->setting_data);

            if (isset($decodeData['admin_number_of_login_attempt']) && $decodeData['admin_number_of_login_attempt'] !== null) {
                $numberOfAttemptsSetting = $decodeData['admin_number_of_login_attempt'];

                $numberOfAttempts = $this->userLoginAttemptServices->list()
                    ->where('email', $email)
                    ->where('status', 0)
                    ->where('user_id', $userId)
                    ->count();

                if ($numberOfAttempts >= $numberOfAttemptsSetting) {
                    if ($user->department_id !== 1 && $user->designation !== '1') {
                        $user->status = 0;
                        $user->save();
                    }
                }

                if (!empty($decodeData['admin_attempt_email_alert'])) {
                    Mail::to($decodeData['admin_attempt_email_alert'])->send(new InvalidLoginAttempt(
                        $email,
                        $ipAddress,
                        "Invalid Attempt Login"
                    ));
                }
            }
        }
    } catch (Exception $e) {
        Log::channel('database')->error('Set User Login Attempt', [
            'error' => $e->getMessage(),
            'stack_trace' => $e->getTraceAsString(),
        ]);

        return response()->view('errors.500', [], 500);
    }
}



    public function logout(Request $request)

    {

        try {

            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            

            return redirect('admin/login');

        } catch (Exception $e) {

            Log::channel('database')->error('User Logout', [

                'error' => $e->getMessage(),

                'stack_trace' => $e->getTraceAsString(),

            ]);

            return response()->view('errors.500', [], 500);

        }

    }



    public function verifytwostep()

    {

        try {

            return view('admin.login-verify-two-step');

        } catch (Exception $e) {

            Log::channel('database')->error('User Login Two Step', [

                'error' => $e->getMessage(),

                'stack_trace' => $e->getTraceAsString(),

            ]);

            return response()->view('errors.500', [], 500);

        }

    }



    public function veryfyLoginTwostep(Request $request)

    {

        try {

            $user = $request->user();

            $google2fa = new Google2FA();

            // Validate the token

            $request->validate([

                'token' => 'required|string',

            ]);

            $window = 2;

            $valid = $google2fa->verifyKey($user->google2fa_secret, $request->input('token'), $window);



            if ($valid) {

                if ($request->filled('remember')) {

                    Auth::login($user, true); // Re-login to trigger "Remember Me"

                }

                $request->session()->put('2fa_passed', true);

                return redirect()->route('admin.dashboard')->with('success', 'Two-Factor Authentication enabled successfully.');

            } else {

                return back()->withErrors(['token' => 'Invalid token, please try again.']);

            }

        } catch (Exception $e) {

            Log::channel('database')->error('User twostep verify check', [

                'error' => $e->getMessage(),

                'stack_trace' => $e->getTraceAsString(),

            ]);

            return response()->view('errors.500', [], 500);

        }

    }



   
    
        public function showAllVerifiedApplicants()
    {
        // Get all verified applicants from the service
        $verifiedApplicants = $this->jobApplicationService->getAllVerifiedApplicants();

        // Return the view with the data
        return view('admin.job.verified_job', compact('verifiedApplicants'));
    }
        
    
        public function showApplicant($applicantId)
        {
            $applicant = $this->verificationService->getApplicantData($applicantId);
           

            // Ensure all relationships are loaded
            // Example: eager loading all necessary relationships
            $applicant = $applicant->load('workExperience', 'educationInformation', 'benefits', 'documents','faqResponses.faq'  );
        //dd($applicant->documents);
        
          $passportImage = $applicant->documents->firstWhere('passport_size_photographs', '!=', null);
        
            // Pass the data to the view
            return view('admin.job.verified_applicant', compact('applicant', 'passportImage'));
        }
        

        
        // public function getapplicantaccount()
        // {
        //     // Fetch all applicants with the count of their job applications from the service
        //     $applicants = $this->applicantService->getAllApplicantsWithJobApplicationsCount();
    
        //     // Return the view with the applicants' data
        //     return view('admin.all_applicant', compact('applicants'));
        // }
        
        public function getapplicantaccount()
        {
            $applicants = $this->applicantService->getAllApplicantsWithJobApplicationsCount();
            return view('admin.all_applicant', compact('applicants'));
        }

    

    
public function destroy($id)
{
    $deleted = $this->applicantService->deleteApplicant($id);

    if ($deleted) {
        return redirect()->back()->with('success', 'Applicant deleted successfully.');
    }

    return redirect()->back()->with('error', 'Failed to delete applicant.');
}

    

    // Example function to generate offer letter

   

   



   

    
    
     public function updateApplicantStatus(Request $request)
    {
        $this->applicantService->updateApplicantStatus($request);

        return redirect()->back()->with('status', 'Applicant status updated successfully!');
    }


    


    public function showJobApplicationStatus($applicantId, $jobId)
    {
        // Get the job application status from the service
        $result = $this->jobApplicationService->getJobApplicationStatus($applicantId, $jobId);

        if ($result === null) {
            abort(404, 'Job application not found.');
        }

        // Pass the data to the view
        return view('applicant.job_application_status', $result);
    }


    public function show($id)
    {
        // Get the notification and its data from the service
        $result = $this->applicantService->getNotificationWithData($id);

        // Pass the data to the view
        return view('applicant.offer_letter', $result);
    }

    public function acceptOffer(Request $request, $id)
    {
        // Use the service to accept the offer
        $message = $this->applicantService->acceptOffer($id);

        // Check if the message indicates the offer was already accepted
        if ($message == 'You have already accepted the offer.') {
            return redirect()->route('notification.show', $id)->with('message', $message);
        }

        // Return success message
        return redirect()->route('notification.show', $id)->with('message', $message);
    }





    public function storeAvailability(Request $request, $applicant_id)
    {
        // ✅ Validate input including name, email, and availability
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'availability' => 'required|array|max:2', // 🔒 LIMIT TO 2
            'availability.*.date' => 'required|date',
            'availability.*.from' => 'required|date_format:H:i',
            'availability.*.to' => 'required|date_format:H:i',
        ]);
    
        $weekStart = Carbon::now()->startOfWeek(); // Monday
        $weekEnd = Carbon::now()->endOfWeek();     // Sunday
    
        foreach ($validated['availability'] as $slot) {
            if (strtotime($slot['to']) <= strtotime($slot['from'])) {
                return back()->withErrors(['Invalid time range for ' . $slot['date']]);
            }
    
            $date = Carbon::parse($slot['date']);
            if (!$date->between($weekStart, $weekEnd)) {
                return back()->withErrors([
                    'availability' => 'Date ' . $slot['date'] . ' must be within the current week (' . $weekStart->format('M d') . ' - ' . $weekEnd->format('M d') . ').'
                ]);
            }
    
            $availableFrom = Carbon::createFromFormat('Y-m-d H:i', $slot['date'] . ' ' . $slot['from'])->format('Y-m-d H:i:s');
            $availableTo = Carbon::createFromFormat('Y-m-d H:i', $slot['date'] . ' ' . $slot['to'])->format('Y-m-d H:i:s');
    
            // Check if the slot already exists
            $result = $this->applicantService->storeAvailability($applicant_id, [
                'availability_date' => $slot['date'],
                'available_from' => $availableFrom,
                'available_to' => $availableTo,
                'name' => $validated['name'],
                'email' => $validated['email'],
            ]);
    
            if (!$result) {
                return back()->withErrors(['availability' => 'The selected time slot for ' . $slot['date'] . ' is already taken. Please select a different date or time.']);
            }
        }
    
        return redirect()->route('applicant.dashboard')
                         ->with('success', 'Your availability has been successfully recorded.');
    }
    
    
    
    


    public function showAvailabilityForm($applicant_id)
    {
        $applicant = $this->applicantService->getApplicant($applicant_id);
        return view('applicant.interviewschedule', compact('applicant'));
    }

public function listAllAvailability()
{
    try {
        $data['pageTitle'] = 'All Interview Availabilities';
        $data['pageDescription'] = 'Manage Interview Time Slots Submitted by Applicants';

        // Now this works perfectly with pagination
        $availabilities = $this->applicantService->listAllAvailability(10);

        return view('admin.interview.interviewdata', compact('data', 'availabilities'));
    } catch (\Exception $e) {
        \Log::error('Interview availability retrieval failed', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);

        return response()->view('errors.500', [], 500);
    }
}

    
public function updateStatusAjax(Request $request)
{
    $request->validate([
        'applicant_id' => 'required|exists:applicants,id',
        'status' => 'required|in:active,inactive',
    ]);

    $applicant = \App\Models\Applicant::find($request->applicant_id);
    $applicant->status = $request->status;
    $applicant->save();

    return response()->json([
        'status' => 200,
        'message' => 'Applicant status updated successfully.'
    ]);
}


    
}

