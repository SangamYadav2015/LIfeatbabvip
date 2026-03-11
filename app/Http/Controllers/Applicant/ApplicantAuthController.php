<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ApplicantServiceInterface; 
use Exception;
use Illuminate\Support\Facades\Log;
use App\Models\JobApplication;
use App\Models\EducationInformation;
use App\Models\PostJob;
use App\Models\Document;
use App\Models\Applicant;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Storage;
use App\Models\WorkExperience;
use App\Models\PersonalInformation;
use App\Models\EduInformation;
use App\Models\Notification;
use App\Models\OfferLetter;
use App\Models\ApplicantDetails;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Services\VerificationService;
use App\Models\CareerSetting;
use Carbon\Carbon; 
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicantRegisterMail;
use App\Mail\VerifyApplicantMail; 
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use PragmaRX\Google2FAQRCode\Google2FA;
use App\Services\ApplicantService;
use App\Repositories\CareerSettingRepository;
use App\Services\ApplicantProfileService;
use App\Services\FaqService;
use App\Services\FaqResponseService; 
use App\Models\Faq;






class ApplicantAuthController extends Controller
{
    protected $applicantService;
    protected $verificationService;
        protected $careerSettingRepository;
    protected $profileService;
        protected $faqService;
protected $faqResponseService;


    public function __construct(ApplicantService $applicantService, VerificationService $verificationService,CareerSettingRepository $careerSettingRepository,ApplicantProfileService $profileService,FaqService $faqService,FaqResponseService $faqResponseService)
{
    $this->applicantService = $applicantService;
    $this->verificationService = $verificationService;
            $this->careerSettingRepository = $careerSettingRepository;
                    $this->profileService = $profileService;
                            $this->faqService = $faqService;
$this->faqResponseService = $faqResponseService; 


}

    
    public function showLoginForm()
    {
        try {

        $careerSettings = $this->careerSettingRepository->list()->get(); // Use ->get() to execute the query
            return view('applicant.login',compact('careerSettings'));; // Create this view
        } catch (Exception $e) {
            Log::channel('database')->error('Applicant Login Form', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

public function login(Request $request)
{
    try {
        // Validate using Applicant model's rules and messages
        $request->validate(
            \App\Models\Applicant::loginRules(),
            \App\Models\Applicant::loginMessages()
        );

        $remember = $request->boolean('remember');

        if (Auth::guard('applicant')->attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ], $remember)) {

            $user = Auth::guard('applicant')->user();

            $user->update([
                            'login_token' => Str::random(64),
                            'login_token_expires_at' => now()->addMinutes(30),
                            'last_login_at' => now(),
                        ]);
            // Redirect if terms not accepted
            if (!$user->terms_accepted) {
                return redirect()->route('applicant.acceptTerms');
            }

             // ❗️Check if status is inactive and logout immediately
    if ($user->status === 'inactive') {
        Auth::guard('applicant')->logout();

        return redirect()->back()
            ->with('account_suspended', 'Your account is suspended for the present time.');
    }

            return redirect('/?email=' . urlencode($user->email))
                ->with('success', 'You have successfully logged in!');
        }

        return redirect()->back()
            ->withErrors(['email' => 'The provided credentials do not match our records.'])
            ->withInput($request->only('email', 'remember'));

    } catch (\Illuminate\Validation\ValidationException $e) {
        Log::channel('database')->error('Validation Error during login', [
            'errors' => $e->errors(),
        ]);
        return redirect()->back()->withErrors($e->validator)->withInput();

    } catch (\Exception $e) {
        Log::channel('database')->error('Applicant Login Error', [
            'error' => $e->getMessage(),
            'stack_trace' => $e->getTraceAsString(),
        ]);
        return response()->view('errors.500', [], 500);
    }
}


    

   public function logout(Request $request)
{
    try {
        $user = Auth::guard('applicant')->user();

        if ($user) {
            // Clear login_token and expiry
            $user->login_token = null;
            $user->login_token_expires_at = null;
            $user->last_login_at = now(); // Optional: update logout time
            $user->save();
        }

        // Logout user and invalidate session
        Auth::guard('applicant')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); // Or any route like route('applicant.login')
    } catch (Exception $e) {
        Log::channel('database')->error('Applicant Logout', [
            'error' => $e->getMessage(),
            'stack_trace' => $e->getTraceAsString(),
        ]);

        return response()->view('errors.500', [], 500);
    }
}


    public function showRegistrationForm()
    {
        try {
            return view('applicant.applicant-register'); // Create this view
        } catch (Exception $e) {
            Log::channel('database')->error('Applicant Registration Form', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
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
        $validated['password'] = bcrypt($validated['password']);

        // Store data in cache
        $tempKey = 'verify_applicant_' . md5($validated['email'] . now());
        cache()->put($tempKey, $validated, now()->addMinutes(15));

        // Generate signed verification URL
        $signedUrl = URL::temporarySignedRoute(
            'applicant.verify-link',
            now()->addMinutes(60),
            ['email' => $validated['email'], 'key' => $tempKey]
        );

        // Send verification email
        Mail::to($validated['email'])->send(
            new VerifyApplicantMail($validated['first_name'], $signedUrl)
        );

        return redirect()->route('applicant.register')
            ->with('success', 'Your account has been created. Please check your email to verify your account.');

    } catch (\Illuminate\Validation\ValidationException $e) {
        Log::channel('database')->error('Validation Error during registration', ['errors' => $e->errors()]);
        return redirect()->back()->withErrors($e->validator)->withInput();
    } catch (\Exception $e) {
        Log::channel('database')->error('Applicant Registration', [
            'error' => $e->getMessage(),
            'stack_trace' => $e->getTraceAsString(),
        ]);
        return response()->view('errors.500', [], 500);
    }
}



public function verify(Request $request)
{
    $email = $request->query('email');
    $key = $request->query('key');

    if (!cache()->has($key)) {
        return redirect()->route('applicant.register')->with('error', 'Verification link expired or invalid.');
    }

    $data = cache()->pull($key); // remove after retrieving

    // Store applicant
    $applicant = Applicant::create($data);

    // Optionally log them in
    Auth::guard('applicant')->login($applicant);

    return redirect()->route('applicant.dashboard')->with('success', 'Your email has been verified and account created.');
}







   public function showForgotPasswordForm()
    {
        try {
            return view('applicant.change-password'); // Create this Blade view
        } catch (Exception $e) {
            Log::channel('database')->error('Applicant Forgot Password Form', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }


    
    // Additional methods for password update, profile management, etc.
   public function dashboard()
    {
        try {
            // Get currently authenticated applicant's ID
            $applicantId = Auth::guard('applicant')->id();
    
            // Fetch applicant data via service
            $applicant = $this->applicantService->getApplicant($applicantId);
    
            // Fetch job applications with related job info
            $applications = $this->applicantService->getJobApplicationsWithPostJob($applicantId);
    
            // Fetch notifications (via relation or method)
            $notifications = $applicant->notifications;
    
            $jobId = $applications->pluck('post_job_id')->unique();
    
            return view('applicant.dashboard', [
                'applications' => $applications,
                'jobId' => $jobId,
                'applicantId' => $applicantId,
                'notifications' => $notifications,
                'applicant' => $applicant,
                'currentStep' => 1,
            ]);
        } catch (\Exception $e) {
            Log::channel('database')->error('Applicant Dashboard Access Error', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
    
            return response()->view('errors.500', [], 500);
        }
    }
    
public function complete()
{
    return view('applicant.verification.complete'); 
    // Change to your actual view path
}

public function showAcceptTerms()
{
    return view('applicant.accept-terms'); // Create this view
}

public function acceptTerms(Request $request)
{
    $applicant = Auth::guard('applicant')->user();
    $applicant->terms_accepted = 1; // Set terms accepted to 1
    $applicant->save(); // Save the applicant's information

    return redirect()->route('applicant.dashboard'); // Redirect to the dashboard
}






public function showVerificationForm($jobId, $applicantId, $step = 1)
{
    // Retrieve the job and application as before
    $job = PostJob::findOrFail($jobId);
    $application = JobApplication::where('job_id', $jobId)
                                  ->where('applicant_id', $applicantId)
                                  ->firstOrFail();
    $applicant = Applicant::findOrFail($applicantId);

    return view('applicant.verification', [
        'job' => $job,
        'applicant' => $applicant,
        'application' => $application,
        'jobId' => $jobId,
        'applicantId' => $applicantId,
        'step' => $step  // Pass step dynamically
    ]);
}





public function storeVerificationData(Request $request)
    {
        // Get the authenticated applicant
        $applicantId = auth()->guard('applicant')->id();
        $jobId = $request->input('job_id'); // Fetch job_id from the request
        
        // Validate the request data based on the current step
        $this->validateRequest($request);

        // Increment the step
        $nextStep = $request->input('step') + 1;

        // Prepare data to pass to the service
        $data = array_merge(
            $request->all(),
            ['applicant_id' => $applicantId, 'job_id' => $jobId]
        );

        try {
            // Handle the verification process for the current step
            $this->verificationService->handleVerificationStep($request->step, $data);
            
            // Redirect to the next step
            return redirect()->route('verification.form', [
                'jobId' => $jobId,
                'applicantId' => $applicantId,
                'step' => $nextStep // Incremented step
            ]);
        } catch (\Exception $e) {
            // Handle exception or invalid step
            return redirect()->route('verification.form', [
                'jobId' => $jobId,
                'applicantId' => $applicantId,
                'step' => 1 // Reset to step 1 if an unknown step is hit
            ])->withErrors(['error' => $e->getMessage()]);
        }
    }


private function validateRequest(Request $request)
{
    $step = $request->step;

    switch ($step) {
        case 1: // Validate Personal Information
            $request->validate([
               
            'first_name'         => 'required|string|max:255',
            'middle_name'        => 'nullable|string|max:255',
            'last_name'          => 'required|string|max:255',
            'date_of_birth'      => 'required|date',
            'email'              => 'required|email|max:255|unique:personal_information,email',
            'phone'              => 'required|string|max:15',
            'house_no'           => 'required|string|max:15',
            'landmark'           => 'nullable|string|max:255',
            'area'               => 'required|string|max:255',
            'current_address'    => 'required|string|max:255',
            'permanent_address'  => 'required|string|max:255',
            'city'               => 'required|string|max:100',
            'state'              => 'required|string|max:100',
            'zip'                => 'required|string|max:20',
            'country'            => 'required|string|max:100',
            'gender'             => 'nullable|in:male,female,other',
                // Add other fields as necessary
            ]);
            break;

            case 2: // Validate Education Information
                $request->validate([
                    'highest_education' => 'required|string|max:255',
                    'tenth_passout_year' => 'required|integer|digits:4', // Validate 10th pass out year
                    'tenth_school' => 'required|string|max:255', // Validate 10th school name
                    'tenth_board_name' => 'required|string|max:255', // Validate 10th board name
                    'tenth_percentage' => 'required|numeric|between:0,100', // Validate 10th percentage
            
                    'twelfth_passout_year' => 'required|integer|digits:4', // Validate 12th pass out year
                    'twelfth_school' => 'required|string|max:255', // Validate 12th school name
                    'twelfth_board_name' => 'required|string|max:255', // Validate 12th board name
                    'twelfth_percentage' => 'required|numeric|between:0,100', // Validate 12th percentage
                    'twelfth_stream' => 'required|string|max:255', // Validate 12th stream
            
                    'degree_level' => 'required|string|max:255', // Validate degree level
                    'institution_name' => 'required|string|max:255', // Validate institution name
                    'degree_specialization' => 'required|string|max:255', // Validate degree specialization
                    'degree_percentage' => 'required|numeric|between:0,100', // Validate degree percentage
            
                    'masters_year' => 'nullable|integer|digits:4', // Validate master's year
                    'university_name' => 'nullable|string|max:255', // Validate university name
                    'masters_specialization' => 'nullable|string|max:255', // Validate master's specialization
                    'masters_percentage' => 'nullable|numeric|between:0,100', // Validate master's percentage
                    'college' => 'nullable|string|max:255', // Validate college
            
                    'skills_relevant' => 'nullable|string', // Validate relevant skills
                ]);
                break;
            

        case 3: // Validate Work Experience
            $request->validate([
                'company_name' => 'required|string|max:255',
                'start_employment_dates' => 'required|date',
                'end_employment_dates' => 'required_if:current_working,0|nullable|date',
                'current_working' => 'boolean',
                'position' => 'required|string',
                // Add other fields as necessary
            ]);
            break;

        case 4: // Validate Documents
            $request->validate([
                'Resume' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'aadhar_card_front' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'aadhar_card_back' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'pan_card' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                
                'passport_size_photographs' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
               
            ]);
            break;

            case 5: // Validate Benefits Information
                $request->validate([
                    // Fields for Benefits
                    'annualgrosscompensation' => 'nullable|string|max:255', // Validate as a string with max length
                    'fixedSalary' => 'nullable|string|max:255', // Validate as a string with max length
                    'variablePay' => 'nullable|string|max:255', // Validate as a string with max length
                    'otherbenefits' => 'nullable|string|max:255', // Validate as a string with max length
                    'nextrevisiondate' => 'nullable|date', // Ensure it's a valid date (if provided)
                    
                   
                ]);
                break;
        default:
            // Optionally handle invalid steps if necessary
            throw new \InvalidArgumentException('Invalid step for validation.');
    }
}







public function showProfile($applicantId)
{
    // Get the authenticated applicant
    $applicant = Auth::guard('applicant')->user();

    // Eager load relationships
    $applicant->load('workExperience', 'educationInformation', 'benefits', 'documents');

    // Find passport image document
    $passportImage = $applicant->documents->firstWhere('passport_size_photographs', '!=', null);

    // Initialize counters
    $totalFields = 0;
    $filledFields = 0;

    // ---------- Personal Information ----------
  $personalFields = [
    'first_name',
    'middle_name',
    'last_name',
    'email',
    'phone',
    'house_no',
    'landmark',
    'area',
    'current_address',
    'permanent_address',
    'city',
    'state',
    'zip',
    'country',
    'date_of_birth',
    'gender',
];

    foreach ($personalFields as $field) {
        $totalFields++;
        if (!empty($applicant->$field)) {
            $filledFields++;
        }
    }

    // ---------- Education Information ----------
    if ($applicant->educationInformation) {
        $edu = $applicant->educationInformation;
        $educationFields = [
            'tenth_passout_year', 'tenth_school', 'tenth_board_name', 'tenth_percentage',
            'twelfth_passout_year', 'twelfth_school', 'twelfth_board_name', 'twelfth_percentage', 'twelfth_stream',
            'degree_level', 'institution_name', 'degree_specialization', 'degree_percentage'
            // Optional fields like diploma/masters are excluded for now
        ];
        foreach ($educationFields as $field) {
            $totalFields++;
            if (!empty($edu->$field)) {
                $filledFields++;
            }
        }
    }

    // ---------- Work Experience ----------
    $totalFields++;
    if ($applicant->workExperience->isNotEmpty()) {
        $filledFields++;
    }

    // ---------- Documents ----------
    $totalFields++;
    if ($passportImage) {
        $filledFields++;
    }

    // ---------- Benefits ----------
    $totalFields++;
    if ($applicant->benefits->isNotEmpty()) {
        $filledFields++;
    }

    // ---------- Final Profile Completion Calculation ----------
    $profileCompletion = $totalFields > 0 ? round(($filledFields / $totalFields) * 100) : 0;

    return view('applicant.profile', [
        'applicant' => $applicant,
        'passportImage' => $passportImage,
        'isProfileComplete' => $profileCompletion === 100,
        'profileCompletion' => $profileCompletion,
    ]);
}







public function storeWorkExperience(Request $request)
{
    $data = $request->validate([
        'work_experience.*.company_name' => 'required|string|max:255',
        'work_experience.*.start_date' => 'required|date',
        'work_experience.*.end_employment_dates' => 'nullable|date', // end_employment_dates is nullable
        'work_experience.*.current_working' => 'required|in:0,1', // current_working should be 0 or 1
    ]);

    foreach ($data['work_experience'] as $workExperience) {
        // Store each work experience entry
        WorkExperience::create([
            'applicant_id' => auth('applicant')->id(),
            'company_name' => $workExperience['company_name'],
            'start_employment_dates' => $workExperience['start_date'],
            'end_employment_dates' => ($workExperience['current_working'] == 1) ? null : $workExperience['end_employment_dates'], // If 'current_working' is 1, don't store an end date
            'current_working' => $workExperience['current_working'], // Store 'current_working' as 0 or 1
        ]);
    }

    return redirect()->back()->with('success', 'Work Experience added successfully!');
}



public function editProfile()
{
    $applicant = Auth::guard('applicant')->user();

    $personal = PersonalInformation::where('applicant_id', $applicant->id)->first();
    $education = EducationInformation::where('applicant_id', $applicant->id)->first();
    $work = WorkExperience::where('applicant_id', $applicant->id)->first();
    $documents = Document::where('applicant_id', $applicant->id)->first();
$faqs = Faq::all()->toArray(); // converts to array


    $step = request()->get('step', 1); // default to step 1
$skills = [];
    if ($work && $work->skills) {
        $skills = explode(',', $work->skills); // convert string to array
    }
    return view('applicant.editAll', compact('applicant', 'personal', 'education', 'work', 'documents', 'step','skills','faqs'));
}



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
        ],            'phone' => 'required|string|max:15',
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
        ]);

        $this->profileService->updatePersonalInfo($id, $validated);

        return redirect()->route('applicant.editProfile', ['applicantId' => $id, 'step' => 2])->with('success', 'Step 1 completed.');
    }
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

        return redirect()->route('applicant.editProfile', ['applicantId' => $id, 'step' => 3])->with('success', 'Step 2 completed.');
    }


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

        return redirect()->route('applicant.editProfile', ['applicantId' => $id, 'step' => 4])->with('success', 'Step 3 completed.');
    }






public function updateDocuments(Request $request, $id)
{
    $validated = $request->validate([
        'Resume' => 'nullable|file|mimes:pdf,doc,docx',
        'aadhar_card_front' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
        'aadhar_card_back' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
        'pan_card' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
        'passport_size_photographs' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
'passport' => 'nullable|in:Yes,No',
'passport_file' => 'required_if:passport,Yes|file|mimes:jpg,jpeg,png,pdf|max:2048',


    ]);

    $this->profileService->updateDocuments($id, $request->only([
        'Resume', 
        'aadhar_card_front', 
        'aadhar_card_back', 
        'pan_card', 
        'passport_size_photographs',
                'passport' ,// also store this
        'passport_file'

    ]));

        return redirect()->route('applicant.editProfile', ['applicantId' => $id, 'step' => 5])->with('success', 'Step 4 completed.');
}

public function updateFaqAnswers(Request $request, $id)
{
    $validated = $request->validate([
        'answer' => 'required|array',
        'answer.*' => 'in:yes,no',
    ]);

    $this->faqResponseService->storeOrUpdateResponses($id, $validated['answer']);

    return redirect()->route('applicant.dashboard')->with('success', 'Step 5 (FAQ responses) updated successfully.');
}




public function updateProfileImage(Request $request, $applicantId)
{
    // Validate the uploaded image
    $validated = $request->validate([
        'passport_size_photographs' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Fetch the applicant's data
    $applicant = $this->verificationService->getApplicantData($applicantId);

    // Check if the document (passport image) exists, or create a new one
    $document = $applicant->documents()->firstOrCreate([
        'applicant_id' => $applicantId
    ]);

    // Check if a new profile image is uploaded
    if ($request->hasFile('passport_size_photographs')) {
        // Delete the old image if it exists
        if ($document->passport_size_photographs) {
            Storage::disk('public')->delete($document->passport_size_photographs);
        }

        // Store the new image
        $imagePath = $request->file('passport_size_photographs')->store('passport_size_photographs', 'public');
        $document->passport_size_photographs = $imagePath; // Update the passport_size_photographs in the 'documents' table
    }

    // Save the updated document record
    $document->save();

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Profile image updated successfully!');
}

// In ApplicantAuthController




    public function showChangePasswordForm()
    {
        return view('applicant.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $applicant = Auth::guard('applicant')->user();

        if (!Hash::check($request->current_password, $applicant->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $applicant->password = Hash::make($request->new_password);
        $applicant->save();

        return redirect()->route('applicant.dashboard')->with('success', 'Password updated successfully.');
    }

    
     public function verifytwostepapplicant()
    {
        try {
            return view('applicant.login-verify-two-step');
        } catch (Exception $e) {
            Log::channel('database')->error('User Login Two Step', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }
    
    public function veryfyLoginTwostepApplicant(Request $request)
    {
        try {
            $user = auth()->guard('applicant')->user();
            $google2fa = new Google2FA();
            // Validate the token
            $request->validate([
                'token' => 'required|string',
            ]);
            $window = 2;
            $valid = $google2fa->verifyKey($user->google2fa_secret, $request->input('token'), $window);

            if ($valid) {
                if ($request->filled('remember')) {
                    Auth::guard('applicant')->login($user, true); // Re-login to trigger "Remember Me"
                }
                $request->session()->put('2fa_passed', true);
                return redirect()->route('applicant.dashboard')->with('success', 'Two-Factor Authentication enabled successfully.');
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


}
