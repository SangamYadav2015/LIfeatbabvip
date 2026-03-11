<?php

namespace App\Http\Controllers\API\Applicant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\Applicant;
use Exception;
use App\Repositories\CareerSettingRepository;
use App\Services\ApplicantService;
use App\Services\VerificationService;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicantRegisterMail;
use App\Mail\VerifyApplicantMail;
use App\Services\ApplicantProfileService;
use Illuminate\Validation\Rule;
use PragmaRX\Google2FA\Google2FA;
use App\Models\PersonalInformation;
use App\Models\EducationInformation;
use App\Models\WorkExperience;
use App\Models\Document;
use App\Models\Faq;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;



 

class ApplicantAuthController extends Controller
{
    protected $careerSettingRepository;
     protected $applicantService;
    protected $verificationService;
        protected $profileService;


    public function __construct(CareerSettingRepository $careerSettingRepository,ApplicantService $applicantService,ApplicantProfileService $profileService,VerificationService $verificationService)
    {
        $this->careerSettingRepository = $careerSettingRepository;
                $this->applicantService = $applicantService;
                $this->profileService = $profileService;
                        $this->verificationService = $verificationService; 


    }
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);

            $credentials = $request->only('email', 'password');

            if (Auth::guard('applicant')->attempt($credentials)) {
                $applicant = Auth::guard('applicant')->user();

                if ($applicant->status === 'inactive') {
                    return response()->json([
                        'status' => false,
                        'message' => 'Your account is currently inactive.',
                    ], 403);
                }

                if (!$applicant->terms_accepted) {
                    return response()->json([
                        'status' => false,
                        'message' => 'You must accept the terms and conditions.',
                    ], 403);
                }

                $applicant->login_token = Str::random(64);
                $applicant->login_token_expires_at = now()->addDays(7);
                $applicant->last_login_at = now();
                $applicant->save();

                return response()->json([
                    'status' => true,
                    'message' => 'Login successful',
                    'data' => [
                        'applicant' => $applicant,
                        'login_token' => $applicant->login_token,
                        'expires_at' => $applicant->login_token_expires_at,
                    ]
                ], 200);
            }

            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials.',
            ], 401);
        } catch (Exception $e) {
            Log::channel('database')->error('Applicant Login', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong during login.',
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $authHeader = $request->header('Authorization');

            if ($authHeader && str_starts_with($authHeader, 'Bearer ')) {
                $token = str_replace('Bearer ', '', $authHeader);
                $applicant = Applicant::where('login_token', $token)->first();

                if ($applicant) {
                    $applicant->login_token = null;
                    $applicant->login_token_expires_at = null;
                    $applicant->save();
                }
            }

            return response()->json([
                'status' => true,
                'message' => 'Logged out successfully.',
            ]);
        } catch (Exception $e) {
            Log::channel('database')->error('Applicant Logout', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'status' => false,
                'message' => 'Logout failed. Try again later.',
            ], 500);
        }
    }

    public function showRegistrationForm()
    {
        return response()->json([
            'status' => true,
            'message' => 'This API is not intended for view rendering. Use web route for registration form.'
        ], 200);
    }
    
    public function showLoginForm()
{
    try {
        $careerSettings = $this->careerSettingRepository->list()->get();

        return response()->json([
            'status' => true,
            'message' => 'Career settings retrieved successfully.',
            'data' => [
                'career_settings' => $careerSettings,
            ]
        ], 200);
    } catch (Exception $e) {
        Log::channel('database')->error('Applicant Login Form API', [
            'error' => $e->getMessage(),
            'stack_trace' => $e->getTraceAsString(),
        ]);

        return response()->json([
            'status' => false,
            'message' => 'An error occurred while fetching the login form data.',
        ], 500);
    }
}

public function register(Request $request)
{
    try {
        $validated = $request->validate([
            // Basic Information
            'first_name'         => 'required|string|max:255',
            'middle_name'        => 'nullable|string|max:255',
            'last_name'          => 'required|string|max:255',
            'email'              => 'required|email|max:255|unique:applicants,email',
            'phone'              => 'required|string|max:20',
            'gender'             => 'nullable|in:male,female,other',

            // Address
            'country'            => 'required|string|max:100',
            'state'              => 'required|string|max:100',
            'city'               => 'required|string|max:100',
            'current_address'    => 'required|string|max:255',
            'permanent_address'  => 'required|string|max:255',

            // Documents
            'resume'             => 'required|file|mimes:pdf,doc,docx|max:2048',
            'cover_letter'       => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'portfolio'          => 'nullable|file|mimes:pdf,doc,docx,url|max:2048',

            // Authentication
            'password'           => 'required|string|min:8|confirmed',

            // Terms and profile
            'profile_image'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'offer_letter_path'  => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'notification'       => 'nullable|string',

            // Google 2FA
            'google2fa_enabled'  => 'nullable|string|max:10',
            'google2fa_secret'   => 'nullable|string|max:255',
        ]);

        // File uploads
        $uploadFields = [
            'resume'             => 'resumes',
            'cover_letter'       => 'cover_letters',
            'portfolio'          => 'portfolios',
            'profile_image'      => 'profile_images',
            'offer_letter_path'  => 'offer_letters',
        ];

        foreach ($uploadFields as $field => $folder) {
            if ($request->hasFile($field)) {
                $validated[$field] = $request->file($field)->store($folder, 'public');
            }
        }


        // Hash password
        $validated['password'] = Hash::make($validated['password']);

        // Store in temporary cache
        $tempKey = 'verify_applicant_' . Str::random(32);
        cache()->put($tempKey, $validated, now()->addMinutes(15));

        // Signed URL
    // $signedUrl = url('/email-verification/applicant') . '?email=' . urlencode($validated['email']) . '&key=' . urlencode($tempKey);
    
    $signedUrl = url('/email-verification/applicant') . '?email=' . urlencode($validated['email']) . '&key=' . urlencode($tempKey);


        // Send email
        Mail::to($validated['email'])->send(
            new VerifyApplicantMail($validated['first_name'], $signedUrl)
        );

        return response()->json([
            'message' => 'Your account has been created. Please check your email to verify your account.',
            'status' => 200,
        ], 200);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'message' => 'Validation failed.',
            'errors' => $e->errors(),
        ], 422);
    } catch (\Exception $e) {
        Log::channel('database')->error('API Applicant Registration Failed', [
            'error' => $e->getMessage(),
            'stack' => $e->getTraceAsString(),
        ]);

        return response()->json([
            'message' => 'Internal server error',
        ], 500);
    }
}

public function verifyEmail(Request $request)
{
    try {
        $validated = $request->validate([
            'email' => 'required|email',
            'key'   => 'required|string',
        ]);

        // Get cached data using the key
        $cachedData = cache()->get($validated['key']);

        if (! $cachedData || $cachedData['email'] !== $validated['email']) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid or expired verification link.',
            ], 404);
        }

        // Set email_verified_at and hash password (already done earlier, but double check)
        $cachedData['email_verified_at'] = now();

        // Create the applicant
        $applicant = Applicant::create($cachedData);

        // Clear cache
        cache()->forget($validated['key']);

        return response()->json([
            'status' => true,
            'message' => 'Email verified and applicant registered successfully.',
        ], 200);

    } catch (\Illuminate\Validation\ValidationException $e) {
        Log::channel('database')->error('Applicant API Verification Validation Error', [
            'errors' => $e->errors(),
        ]);

        return response()->json([
            'status' => false,
            'message' => 'Validation failed.',
            'errors' => $e->errors(),
        ], 422);
    } catch (\Exception $e) {
        Log::channel('database')->error('Applicant Email Verification Exception', [
            'error' => $e->getMessage(),
        ]);

        return response()->json([
            'status' => false,
            'message' => 'An unexpected error occurred.',
        ], 500);
    }
}





public function showForgotPasswordForm()
{
    try {
        return response()->json([
            'status' => true,
            'message' => 'Forgot password form data loaded successfully.',
            'data' => [
                'fields' => [
                    'email' => 'required|string|email|max:255'
                ],
                'note' => 'Enter your registered email to receive password reset instructions.'
            ]
        ], 200);
    } catch (Exception $e) {
        Log::channel('database')->error('Applicant Forgot Password Form API Error', [
            'error' => $e->getMessage(),
            'stack_trace' => $e->getTraceAsString(),
        ]);
        return response()->json([
            'status' => false,
            'message' => 'Something went wrong while loading forgot password form.',
        ], 500);
    }
}
public function dashboard()
{
    try {
        $applicantId = Auth::guard('applicant')->id();

        if (!$applicantId) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthenticated. Please log in.',
            ], 401);
        }

        $applicant = $this->applicantService->getApplicant($applicantId);
        $applications = $this->applicantService->getJobApplicationsWithPostJob($applicantId);
        $notifications = $applicant->notifications ?? [];
        $jobId = $applications->pluck('post_job_id')->unique();

        return response()->json([
            'status' => true,
            'message' => 'Dashboard data retrieved successfully.',
            'data' => [
                'applicant' => $applicant,
                'applications' => $applications,
                'job_ids' => $jobId,
                'notifications' => $notifications,
                'current_step' => 1,
            ]
        ], 200);

    } catch (\Exception $e) {
        Log::channel('database')->error('Applicant Dashboard API Error', [
            'error' => $e->getMessage(),
            'stack_trace' => $e->getTraceAsString(),
        ]);

        return response()->json([
            'status' => false,
            'message' => 'Something went wrong while loading dashboard.',
        ], 500);
    }
}



public function showChangePasswordFormApi()
{
    try {
        return response()->json([
            'status' => true,
            'message' => 'Change password form data loaded successfully.',
            'data' => [
                'fields' => [
                    'current_password' => 'required|string',
                    'new_password' => 'required|string|min:8|confirmed',
                ],
                'note' => 'Please enter your current password and confirm the new one.'
            ]
        ], 200);
    } catch (\Exception $e) {
        \Log::channel('database')->error('Change Password Form API Error', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);

        return response()->json([
            'status' => false,
            'message' => 'Failed to load change password form data.',
        ], 500);
    }
}


public function updatePasswordApi(Request $request)
{
    try {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $applicant = Auth::guard('applicant')->user();

        if (!$applicant) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized. Please log in.',
            ], 401);
        }

        if (!Hash::check($request->current_password, $applicant->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Current password is incorrect.',
            ], 400);
        }

        $applicant->password = Hash::make($request->new_password);
        $applicant->save();

        return response()->json([
            'status' => true,
            'message' => 'Password updated successfully.',
        ], 200);

    } catch (\Illuminate\Validation\ValidationException $e) {
        // Get the first validation error message
        $firstErrorMessage = collect($e->errors())->flatten()->first();

        return response()->json([
            'status' => false,
            'message' => $firstErrorMessage ?? 'Validation failed.',
        ], 422);

    } catch (\Exception $e) {
        \Log::channel('database')->error('Update Password API Error', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);

        return response()->json([
            'status' => false,
            'message' => 'An error occurred while updating the password.',
        ], 500);
    }
}

public function acceptTermsApi(Request $request)
{
    try {
        $applicant = Auth::guard('applicant')->user();

        if (!$applicant) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized. Please log in.',
            ], 401);
        }

        $applicant->terms_accepted = 1;
        $applicant->save();

        return response()->json([
            'status' => true,
            'message' => 'Terms and conditions accepted successfully.',
        ], 200);

    } catch (\Exception $e) {
        \Log::channel('database')->error('Accept Terms API Error', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);

        return response()->json([
            'status' => false,
            'message' => 'An error occurred while accepting terms.',
        ], 500);
    }
}

public function showAcceptTermsApi()
{
    try {
        return response()->json([
            'status' => true,
            'message' => 'Terms and Conditions page loaded successfully.',
            'data' => [
                'title' => 'Terms and Conditions',
                'description' => 'Please read and accept the terms and conditions to proceed.',
                'fields' => [
                    'terms_accepted' => 'required|boolean'
                ],
                'note' => 'You must accept the terms before continuing to your dashboard.'
            ]
        ], 200);
    } catch (\Exception $e) {
        \Log::channel('database')->error('Show Accept Terms API Error', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);

        return response()->json([
            'status' => false,
            'message' => 'Failed to load terms and conditions content.',
        ], 500);
    }
}

public function verifyTwoStepApplicantApi(Request $request)
{
    try {
        $user = Auth::guard('applicant')->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized. Please log in.',
            ], 401);
        }

        $request->validate([
            'token' => 'required|string',
        ]);

        $google2fa = new Google2FA();
        $window = 2;

        $isValid = $google2fa->verifyKey($user->google2fa_secret, $request->input('token'), $window);

        if ($isValid) {
            // Optionally: mark the user as 2FA-verified in DB or session if needed
            return response()->json([
                'status' => true,
                'message' => 'Two-Factor Authentication verified successfully.',
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Invalid token, please try again.',
            ], 422);
        }

    } catch (Exception $e) {
        Log::channel('database')->error('Two-Step Verification API Error', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);

        return response()->json([
            'status' => false,
            'message' => 'An error occurred during two-step verification.',
        ], 500);
    }
}

 // Update Personal Information
  public function updatePersonalInfo(Request $request, $id)
{
    $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'last_name' => 'required|string|max:255',
        'date_of_birth' => 'required|date',
        'email' => [
            'required',
            'email',
            Rule::unique('personal_information', 'email')->ignore($id, 'applicant_id'),
        ],
        'phone' => 'required|string|max:15',
        'house_no' => 'required|string|max:15',
        'landmark' => 'nullable|string|max:255',
        'area' => 'required|string|max:255',
        'current_address' => 'required|string|max:255',
        'permanent_address' => 'required|string|max:255',
        'city' => 'required|string|max:100',
        'state' => 'required|string|max:100',
        'zip' => 'required|string|max:20',
        'country' => 'required|string|max:100',
        'gender' => 'nullable|in:male,female,other',
        'job_id' => 'required|integer',
    ]);

    // ðŸ‘‡ Add applicant_id from URL
    $validated['applicant_id'] = $id;

    $this->profileService->updatePersonalInfo($id, $validated);

    return response()->json([
        'message' => 'Personal information updated successfully',
        'status' => 'success'
    ]);
}

    // Update Education Information
    public function updateEducationInfo(Request $request, $id)
    {
        $validated = $request->validate([
            'highest_education' => 'string|max:255',
            'tenth_passout_year' => 'required|integer|digits:4',
            'tenth_school' => 'required|string|max:255',
            'tenth_board_name' => 'required|string|max:255',
            'tenth_percentage' => 'required|numeric|between:0,100',
            'twelfth_passout_year' => 'required|integer|digits:4',
            'twelfth_school' => 'required|string|max:255',
            'twelfth_board_name' => 'required|string|max:255',
            'twelfth_percentage' => 'required|numeric|between:0,100',
            'twelfth_stream' => 'required|string|max:255',
            'has_diploma' => 'boolean',
            'diploma_name' => 'nullable|string|max:255',
            'diploma_specialization' => 'nullable|string|max:255',
            'diploma_percentage' => 'nullable|numeric|between:0,100',
            'diploma_institution' => 'nullable|string|max:255',
            'diploma_passout_year' => 'nullable|integer|digits:4',
            'has_degree' => 'boolean',
            'degree_level' => 'nullable|string|max:255',
            'degree_specialization' => 'nullable|string|max:255',
            'degree_percentage' => 'nullable|numeric|between:0,100',
            'degree_institution' => 'nullable|string|max:255',
            'degree_passout_year' => 'nullable|integer|digits:4',
            'masters_specialization' => 'nullable|string|max:255',
            'masters_percentage' => 'nullable|numeric|between:0,100',
            'masters_institution' => 'nullable|string|max:255',
            'masters_passout_year' => 'nullable|integer|digits:4',
            'skills_relevant' => 'nullable|string',
        ]);

        $this->profileService->updateEducationInfo($id, $validated);

        return response()->json([
            'message' => 'Education information updated successfully',
            'status' => 'success'
        ]);
    }

    // Update Work Information
    public function updateWorkInfo(Request $request, $id)
    {
        $validated = $request->validate([
              'company_name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'employment_type' => 'required|in:Remote,Hybrid,Full Time',
            'current_working' => 'nullable|boolean',
            'start_month' => 'required|string|max:15',
            'start_year' => 'required|integer|digits:4',
            'end_month' => 'nullable|string|max:15',
            'end_year' => 'nullable|integer|digits:4',
            'location' => 'nullable|string|max:255',
            'salary_ctc' => 'nullable|string|max:255',
            'skills' => 'nullable|array',
            'skills.*' => 'string|max:50',
            'position' => 'nullable|string',
        ]);

        $this->profileService->updateWorkInfo($id, $validated);

        return response()->json([
            'message' => 'Work experience updated successfully',
            'status' => 'success'
        ]);
    }

    // Update Document Files
    public function updateDocuments(Request $request, $id)
    {
        $validated = $request->validate([
            'Resume' => 'nullable|file|mimes:pdf,doc,docx',
            'aadhar_card_front' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'aadhar_card_back' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'pan_card' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'passport_size_photographs' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ]);

        $this->profileService->updateDocuments($id, $request->only([
            'Resume',
            'aadhar_card_front',
            'aadhar_card_back',
            'pan_card',
            'passport_size_photographs'
        ]));

        return response()->json([
            'message' => 'Documents updated successfully',
            'status' => 'success'
        ]);
    }
    
    public function updateFaqAnswers(Request $request, $id)
    {
        $validated = $request->validate([
            'answer' => 'required|array',
            'answer.*' => 'in:yes,no',
        ]);
    
        $this->faqResponseService->storeOrUpdateResponses($id, $validated['answer']);
    
        return response()->json([
            'status' => 'success',
            'message' => 'Step 5 (FAQ responses) updated successfully.'
        ]);
    }

public function getProfileDetails(Request $request)
{
    $applicant = Auth::guard('applicant')->user();

    if (!$applicant) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    $personal = PersonalInformation::where('applicant_id', $applicant->id)->first();
    $education = EducationInformation::where('applicant_id', $applicant->id)->first();
    $work = WorkExperience::where('applicant_id', $applicant->id)->first();
    $documents = Document::where('applicant_id', $applicant->id)->first();
    $faqs = Faq::all();

    $skills = [];
    if ($work && $work->skills) {
        $skills = explode(',', $work->skills);
    }

    return response()->json([
        'applicant' => $applicant,
        'personal' => $personal,
        'education' => $education,
        'work' => $work,
        'documents' => $documents,
        'skills' => $skills,
        'faqs' => $faqs,
        'step' => $request->get('step', 1),
    ]);
}



public function showProfile()
{
    $applicant = auth('applicant')->user();

    if (!$applicant) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    $applicant->load([
        'workExperience',
        'educationInformation',
        'benefits',
        'documents'
    ]);
 
   $workExperience = $applicant->workExperience->map(function ($work) {
    // If skills is a string JSON → decode
    if (is_string($work->skills)) {
        $decoded = json_decode($work->skills, true);
        $work->skills = $decoded ?? [$work->skills];
    }

    // If it's already array → normalize inner values
    if (is_array($work->skills)) {
        $work->skills = collect($work->skills)->map(function ($skill) {
            if (is_string($skill)) {
                $decoded = json_decode($skill, true);
                return (json_last_error() === JSON_ERROR_NONE) ? $decoded : $skill;
            }
            return $skill;
        })->flatten()->unique()->values()->all();
    }

    return $work;
});
    return response()->json($applicant);
}


public function editProfileApi()
{
    $applicant = auth('applicant')->user();

    if (!$applicant) {
        return response()->json([
            'success' => false,
            'message' => 'Applicant not authenticated'
        ], 401);
    }

    // Fetch related step-wise data
    $personalInfo   = $applicant->personalInformation;
    $educationInfo  = $applicant->educationInformation;
    $workExperience = $applicant->workExperience;
    $documents      = $applicant->documents;
    $faqs = Faq::select('id')->get();
// Get applicant responses (if saved in faq_responses table)
 $faqResponse = \App\Models\FaqResponse::where('applicant_id', $applicant->id)->first();

$faqs = collect(json_decode($faqResponse->responses, true))->map(function ($resp) {
    $question = \App\Models\Faq::find($resp['question_id']);
    return [
        'question_id' => $resp['question_id'],
        'question'    => $question ? $question->question : null,
        'answer'      => $resp['answer'],
    ];
});
    // Step completion tracking
    $steps = [
        'step_1' => !empty($personalInfo),
        'step_2' => !empty($educationInfo),
        'step_3' => !empty($workExperience),
        'step_4' => !empty($documents),
        'step_5' => $faqs->isNotEmpty(),
    ];

    $completedSteps = collect($steps)->filter()->count();
    $workExperience = $applicant->workExperience;

$workExperience = $applicant->workExperience->map(function ($work) {
    // If skills is a string JSON → decode
    if (is_string($work->skills)) {
        $decoded = json_decode($work->skills, true);
        $work->skills = $decoded ?? [$work->skills];
    }

    // If it's already array → normalize inner values
    if (is_array($work->skills)) {
        $work->skills = collect($work->skills)->map(function ($skill) {
            if (is_string($skill)) {
                $decoded = json_decode($skill, true);
                return (json_last_error() === JSON_ERROR_NONE) ? $decoded : $skill;
            }
            return $skill;
        })->flatten()->unique()->values()->all();
    }

    return $work;
});



    return response()->json([
        'success'         => true,
        'applicant_id'    => $applicant->id,
        'completed_steps' => $completedSteps,
        'steps'           => [
            'personal_information'  => $personalInfo,
            'education_information' => $educationInfo,
            'work_experience'       => $workExperience,
            'documents'             => $documents,
            'faqs'                  => $faqs,
        ]
    ]);
}


public function updateProfileApi(Request $request)
{
    $applicant = auth('applicant')->user();

    if (!$applicant) {
        return response()->json([
            'success' => false,
            'message' => 'Applicant not authenticated'
        ], 401);
    }

    $step = $request->input('step');

    if (!$step || !in_array($step, [1, 2, 3, 4, 5])) {
        return response()->json([
            'success' => false,
            'message' => 'Invalid or missing step number'
        ], 422);
    }

    try {
        switch ($step) {
            case 1: // Personal Information
                $validated = $request->validate([
                    'first_name'        => 'required|string|max:255',
                    'middle_name'       => 'nullable|string|max:255',
                    'last_name'         => 'required|string|max:255',
                    'date_of_birth'     => 'required|date_format:d-m-Y',
                    'email'             => [
                        'required',
                        'email',
                        Rule::unique('personal_information', 'email')
                            ->ignore($applicant->id, 'applicant_id'),
                    ],
                    'phone'             => 'required|string|max:15',
                    'house_no'          => 'required|string|max:15',
                    'landmark'          => 'nullable|string|max:255',
                    'area'              => 'required|string|max:255',
                    'current_address'   => 'required|string|max:255',
                    'permanent_address' => 'required|string|max:255',
                    'city'              => 'required|string|max:100',
                    'state'             => 'required|string|max:100',
                    'zip'               => 'required|string|max:20',
                    'country'           => 'required|string|max:100',
                    'gender'            => 'nullable|in:male,female,other',
                ]);

                $validated['date_of_birth'] = Carbon::createFromFormat('d-m-Y', $validated['date_of_birth'])
                    ->format('Y-m-d');

                $applicant->personalInformation()->updateOrCreate(
                    ['applicant_id' => $applicant->id],
                    $validated
                );
                break;

            case 2: // Education Information
                $validated = $request->validate([
                    'highest_education'      => 'string|max:255',
                    'tenth_passout_year'     => 'required|integer|digits:4',
                    'tenth_school'           => 'required|string|max:255',
                    'tenth_board_name'       => 'required|string|max:255',
                    'tenth_percentage'       => 'required|numeric|between:0,100',
                    'twelfth_passout_year'   => 'required|integer|digits:4',
                    'twelfth_school'         => 'required|string|max:255',
                    'twelfth_board_name'     => 'required|string|max:255',
                    'twelfth_percentage'     => 'required|numeric|between:0,100',
                    'twelfth_stream'         => 'required|string|max:255',
                    'has_diploma'            => 'boolean',
                    'diploma_name'           => 'nullable|string|max:255',
                    'diploma_specialization' => 'nullable|string|max:255',
                    'diploma_percentage'     => 'nullable|numeric|between:0,100',
                    'diploma_institution'    => 'nullable|string|max:255',
                    'diploma_passout_year'   => 'nullable|integer|digits:4',
                    'has_degree'             => 'boolean',
                    'degree_level'           => 'nullable|string|max:255',
                    'degree_specialization'  => 'nullable|string|max:255',
                    'degree_percentage'      => 'nullable|numeric|between:0,100',
                    'degree_institution'     => 'nullable|string|max:255',
                    'degree_passout_year'    => 'nullable|integer|digits:4',
                    'masters_specialization' => 'nullable|string|max:255',
                    'masters_percentage'     => 'nullable|numeric|between:0,100',
                    'masters_institution'    => 'nullable|string|max:255',
                    'masters_passout_year'   => 'nullable|integer|digits:4',
                    'skills_relevant'        => 'nullable|string',
                ]);

                $applicant->educationInformation()->updateOrCreate(
                    ['applicant_id' => $applicant->id],
                    $validated
                );
                break;
case 3: // Work Experience (hasMany)
    $validated = $request->validate([
        'work_experiences'                    => 'array',
        'work_experiences.*.id'                => 'nullable|integer|exists:work_experiences,id',
        'work_experiences.*.company_name'      => 'required|string|max:255',
        'work_experiences.*.designation'       => 'required|string|max:255',
        'work_experiences.*.employment_type'   => 'required|in:Remote,Hybrid,Full Time',
        'work_experiences.*.current_working'   => 'nullable|boolean',
        'work_experiences.*.start_month'       => 'required|string|max:15',
        'work_experiences.*.start_year'        => 'required|integer|digits:4',
        'work_experiences.*.end_month'         => 'nullable|string|max:15',
        'work_experiences.*.end_year'          => 'nullable|integer|digits:4',
        'work_experiences.*.location'          => 'nullable|string|max:255',
        'work_experiences.*.salary_ctc'        => 'nullable|string|max:255',
        'work_experiences.*.skills'            => 'nullable|array',
        'work_experiences.*.skills.*'          => 'string|max:50',
        'work_experiences.*.position'          => 'nullable|string',
    ]);

    $sentIds = collect($validated['work_experiences'])
        ->pluck('id')
        ->filter()
        ->toArray();

    // 🔹 Delete old records not sent
    $applicant->workExperience()
        ->whereNotIn('id', $sentIds)
        ->delete();
        
 
    foreach ($validated['work_experiences'] as $experience) {
       
   $skills = $experience['skills'] ?? [];

    // Flatten nested JSON strings
    if (is_array($skills)) {
        foreach ($skills as $k => $s) {
            // If item is a JSON string, decode it
            if (is_string($s)) {
                $decoded = json_decode($s, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $skills[$k] = $decoded;
                }
            }
        }
        // Flatten in case of nested arrays
        $skills = collect($skills)->flatten()->filter()->unique()->values()->all();
    } elseif (is_string($skills)) {
        // If entire skills is a single string, decode
        $decoded = json_decode($skills, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            $skills = $decoded;
        } else {
            $skills = [$skills];
        }
    } else {
        $skills = [];
    }


        if (!empty($experience['id'])) {
            // 🔹 Update existing
            $work = $applicant->workExperience()->where('id', $experience['id'])->first();
            if ($work) {
                $work->update([
                    'designation'     => $experience['designation'],
                    'employment_type' => $experience['employment_type'],
                    'company_name'    => $experience['company_name'],
                    'current_working' => $experience['current_working'] ?? 0,
                    'start_month'     => $experience['start_month'],
                    'start_year'      => $experience['start_year'],
                    'end_month'       => $experience['end_month'] ?? null,
                    'end_year'        => $experience['end_year'] ?? null,
                    'location'        => $experience['location'] ?? null,
                    'salary_ctc'      => $experience['salary_ctc'] ?? null,
'skills' => json_encode($skills, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                    'position'        => $experience['position'] ?? null,
                ]);
            }
        } else {
            // 🔹 Create new
            $applicant->workExperience()->create([
                'designation'     => $experience['designation'],
                'employment_type' => $experience['employment_type'],
                'company_name'    => $experience['company_name'],
                'current_working' => $experience['current_working'] ?? 0,
                'start_month'     => $experience['start_month'],
                'start_year'      => $experience['start_year'],
                'end_month'       => $experience['end_month'] ?? null,
                'end_year'        => $experience['end_year'] ?? null,
                'location'        => $experience['location'] ?? null,
                'salary_ctc'      => $experience['salary_ctc'] ?? null,
'skills' => json_encode($skills, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                'position'        => $experience['position'] ?? null,
            ]);
        }
    }

    // 🔹 Always return fresh data
    $applicant->load('workExperience');
    return response()->json([
        'success' => true,
        'message' => 'Work experience updated successfully',
        
    ]);




                break;

            case 4: // Documents (hasOne)
                if ($request->has('passport')) {
                    $request->merge([
                        'passport' => ucfirst(strtolower($request->passport))
                    ]);
                }

                $validated = $request->validate([
                    'Resume'                    => 'nullable|file|mimes:pdf,doc,docx',
                    'aadhar_card_front'         => 'nullable|file|mimes:pdf,jpg,jpeg,png',
                    'aadhar_card_back'          => 'nullable|file|mimes:pdf,jpg,jpeg,png',
                    'pan_card'                  => 'nullable|file|mimes:pdf,jpg,jpeg,png',
                    'passport_size_photographs' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
                    'passport'                  => 'nullable|in:Yes,No',
                    'passport_file'             => 'required_if:passport,Yes|file|mimes:jpg,jpeg,png,pdf|max:2048',
                ]);

                $paths = [];
                $paths['passport'] = $validated['passport'] ?? null;

                foreach (['Resume', 'aadhar_card_front', 'aadhar_card_back', 'pan_card', 'passport_size_photographs', 'passport_file'] as $key) {
                    if ($request->hasFile($key)) {
                        $paths[$key] = $validated[$key]->store("documents/{$applicant->id}", 'public');
                    }
                }

                $applicant->documents()->updateOrCreate(
                    ['applicant_id' => $applicant->id],
                    $paths
                );
                break;

case 5: // FAQs (Yes/No stored as JSON)
    $validated = $request->validate([
        'responses'              => 'required|array',
        'responses.*.id'         => 'nullable|integer|exists:faq_responses,id',
        'responses.*.question_id'=> 'required|integer|exists:faqs,id',
        'responses.*.answer'     => 'required|in:yes,no',
    ]);

    $responsesWithText = collect($validated['responses'])->map(function ($resp) {
        $question = \App\Models\Faq::find($resp['question_id']);
        return [
            'question_id' => $resp['question_id'],
            'question'    => $question ? $question->question : null,
            'answer'      => $resp['answer'],
        ];
    })->toArray();

    \App\Models\FaqResponse::updateOrCreate(
        ['applicant_id' => $applicant->id],
        ['responses'    => json_encode($responsesWithText)]
    );
    break;



        }

        return response()->json([
            'success' => true,
            'message' => "Step {$step} updated successfully"
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Update failed',
            'error'   => $e->getMessage()
        ], 500);
    }
}


// Upload API



public function profileImage(Request $request)
{
    $applicant = Auth::guard('applicant')->user();

    if (!$applicant) {
        return response()->json([
            'success' => false,
            'message' => 'Applicant not authenticated'
        ], 401);
    }

    // Get or create applicant documents
    $document = $applicant->documents()->firstOrCreate([
        'applicant_id' => $applicant->id,
    ]);

    // ✅ Update / Replace profile image
    if ($request->hasFile('passport_size_photographs')) {
        $validated = $request->validate([
            'passport_size_photographs' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Delete old image if exists
        if (!empty($document->passport_size_photographs) && Storage::disk('public')->exists($document->passport_size_photographs)) {
            Storage::disk('public')->delete($document->passport_size_photographs);
        }

        // Save new image
        $imagePath = $request->file('passport_size_photographs')
            ->store('passport_size_photographs', 'public');

        $document->update([
            'passport_size_photographs' => $imagePath
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Profile image updated successfully!',
            'image_url' => asset('storage/' . $imagePath),
        ]);
    }

    // ✅ If only fetching image
    if (empty($document->passport_size_photographs)) {
        return response()->json([
            'success' => false,
            'message' => 'No profile image found'
        ], 404);
    }

    return response()->json([
        'success' => true,
        'image_url' => asset('storage/' . $document->passport_size_photographs)
    ]);
}




public function profileImageupdate(Request $request)
{
    $applicant = Auth::guard('applicant')->user();

    if (!$applicant) {
        return response()->json([
            'success' => false,
            'message' => 'Applicant not authenticated'
        ], 401);
    }

    // Get or create applicant documents
    $document = $applicant->documents()->firstOrCreate([
        'applicant_id' => $applicant->id,
    ]);

    // ✅ Update / Replace profile image
    if ($request->hasFile('passport_size_photographs')) {
        $validated = $request->validate([
            'passport_size_photographs' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Delete old image if exists
        if (!empty($document->passport_size_photographs) && Storage::disk('public')->exists($document->passport_size_photographs)) {
            Storage::disk('public')->delete($document->passport_size_photographs);
        }

        // Save new image
        $imagePath = $request->file('passport_size_photographs')
            ->store('passport_size_photographs', 'public');

        $document->update([
            'passport_size_photographs' => $imagePath
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Profile image updated successfully!',
            'image_url' => asset('storage/' . $imagePath),
        ]);
    }

    // ✅ If only fetching image
    if (empty($document->passport_size_photographs)) {
        return response()->json([
            'success' => false,
            'message' => 'No profile image found'
        ], 404);
    }

    return response()->json([
        'success' => true,
        'image_url' => asset('storage/' . $document->passport_size_photographs)
    ]);
}


}
