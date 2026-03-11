<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Applicant;
use App\Models\ContactEnquery;
use App\Models\Subscriber;
use App\Services\MenuService;
use App\Services\PageService;
use App\Services\PageSectionService;
use App\Services\SettingService;
use App\Services\HelpFaqService;
use App\Services\BlogService;
use App\Services\SectionService;
use App\Services\SectionStyleService;
use App\Services\MaintinanceEnqueryService;
use App\Services\TeamService;
use App\Services\HelpCategoryService;
use App\Services\ContactEnqueryService;
use App\Services\SubscriberService;
use App\Services\PostJobService;
use App\Services\DepartmentService;
use App\Services\LocationService;
use App\Services\PrivacyPolicyCategoryService;

use App\Mail\ContactUsMail;
use App\Mail\SubscriberMail;
use Illuminate\Support\Facades\Mail;
use App\Traits\ValidatesRequests;

use stdClass;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class SiteController extends Controller
{
    use ValidatesRequests;

    protected $menuService;
    protected $pageService;
    protected $pageSectionService;
    protected $settingService;
    protected $blogService;
    protected $helpFaqService;

    protected $sectionService;
    protected $sectionStyleService;
    protected $maintinanceEnqueryService;
    protected $teamService;
    protected $helpCategoryService;
    protected $contactEnqueryService;
    protected $subscriberService;
    protected $postJobService;
    protected $departmentService;
    protected $locationService;
    protected $privacyPolicyCategoryService;


    public function __construct(
        MenuService $menuService,
        PageService $pageService,
        PageSectionService $pageSectionService,
        SettingService $settingService,
        BlogService $blogService,
        HelpFaqService $helpFaqService,
        SectionService $sectionService,
        SectionStyleService $sectionStyleService,
        MaintinanceEnqueryService $maintinanceEnqueryService,
        TeamService $teamService,
        HelpCategoryService $helpCategoryService,
        ContactEnqueryService $contactEnqueryService,
        SubscriberService $subscriberService,
        PostJobService $postJobService,
        DepartmentService $departmentService,
        LocationService $locationService,
        PrivacyPolicyCategoryService $privacyPolicyCategoryService


    ) {
        $this->menuService = $menuService;
        $this->pageService = $pageService;
        $this->pageSectionService = $pageSectionService;
        $this->settingService = $settingService;
        $this->blogService = $blogService;
        $this->helpFaqService = $helpFaqService;
        $this->sectionService = $sectionService;
        $this->sectionStyleService = $sectionStyleService;
        $this->maintinanceEnqueryService = $maintinanceEnqueryService;
        $this->teamService = $teamService;
        $this->helpCategoryService = $helpCategoryService;
        $this->contactEnqueryService = $contactEnqueryService;
        $this->subscriberService = $subscriberService;
        $this->postJobService = $postJobService;
        $this->departmentService = $departmentService;
        $this->locationService = $locationService;
        $this->privacyPolicyCategoryService = $privacyPolicyCategoryService;

    }

    public function headMenu()
    {
        try {
            $menuList = $this->menuService->list()->with('childrenRecursive.pages', 'pages')
                ->whereNull('parent_id')
                ->where('show_header', '1')
                ->where('status', 'active')
                ->orderBy('sort_id', 'ASC')
                ->get();
    
            $formattedMenuList = $menuList->map(function ($menu) {
                return $this->formatMenuData($menu);
            });
    
            return response()->json([
                "data" => $formattedMenuList,
                "message" => "Successfully retrieved",
                "status" => 200
            ]);
        } catch (Exception $e) {
            Log::channel('database')->error('Header Menu API Error', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
    
            return response()->json([
                "message" => "Something went wrong",
                "status" => 500
            ]);
        }
    }
    
    /**
     * Recursively formats menu data, ensuring `pages->page_data` is properly decoded.
     */
    private function formatMenuData($menu)
    {
        $menuData = $menu->toArray();
    
        // Decode pages->page_data if exists
        if (!empty($menu->pages)) {
            $menuData['pages'] = $menu->pages->toArray(); // Convert entire pages model to array
            if (!empty($menu->pages->page_data)) {
                $menuData['pages']['page_data'] = json_decode($menu->pages->page_data, true);
            }
        }
    
        // Process children recursively
        if (!empty($menu->childrenRecursive)) {
            $menuData['children_recursive'] = $menu->childrenRecursive->map(function ($child) {
                return $this->formatMenuData($child);
            })->toArray();
        }
    
        return $menuData;
    }
    
    

    
    public function footerMenu()
    {
        try {
            $menuList = $this->menuService->list()->with('childrenRecursive.pages', 'pages')
                ->whereNull('parent_id')
                ->where('show_footer', '1')
                ->where('status', 'active')
                ->orderBy('sort_id', 'ASC')
                ->get();
    
            $formattedMenuList = $menuList->map(function ($menu) {
                return $this->formatMenuData($menu);
            });
    
            return response()->json([
                "data" => $formattedMenuList,
                "message" => "Successfully retrieved",
                "status" => 200
            ]);
        } catch (Exception $e) {
            Log::channel('database')->error('Footer Menu API Error', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
    
            return response()->json([
                "message" => "Something went wrong",
                "status" => 500
            ]);
        }
    }
    
    
    
    public function isHomePage()
    {
        try {
        $pageData = $this->pageService->list()
        ->where('status', 'active')->where('is_home', true)
        ->first(); 
        
        if (empty($pageData)) {
            return response()->json([
                "message" => "Home Page Not Set",
                "status" => "develpoment"
            ]);
        } else {

            $pageData->page_data = json_decode($pageData->page_data, true);
            
            $pageSectiponData = $this->pageSectionService->list()
            ->where('page_id', $pageData->id)
            ->where('status', 'active')
            ->orderBy('sort_id', 'ASC')
            ->get()
            ->makeHidden(['html_content']); // Hides html_content field
        
        foreach ($pageSectiponData as $pagesection) {
            // Decode `page_section_data` JSON into an array
            $pagesection->page_section_data = json_decode($pagesection->page_section_data, true);
        
            // Fetch section name
            $section = $this->sectionService->sectionList()->where('id', $pagesection->section_id)->first();
            $pagesection->section_name = $section ? $section->section_name : null;
        
            // Fetch section style name
            $sectionStyle = $this->sectionStyleService->sectionStyleList()->where('id', $pagesection->section_style_id)->first();
            $pagesection->section_style_name = $sectionStyle ? $sectionStyle->section_style_name : null;
        }
        
        return response()->json([
            "page_data"=>$pageData,
            "page_section_data" => $pageSectiponData,
            "message" => "Successfully retrieved",
            "status" => 200
        ]);
    }
    } catch (Exception $e) {
        Log::channel('database')->error('Site Setting  API Error', [
            'error' => $e->getMessage(),
            'stack_trace' => $e->getTraceAsString(),
        ]);
        return response()->json([
            "message" => "Something went wrong",
            "status" => 500
        ]);
    }
    }
    public function siteSetting()
    {
        try {
            $settings = $this->settingService->list()
            ->whereIn('setting_type', ['site_setting', 'footer_setting'])
            ->get();
        
        // Decode `setting_data` for each setting
        foreach ($settings as $setting) {
            if (isset($setting->setting_data)) {
                $setting->setting_data = json_decode($setting->setting_data, true);
            }
        }
        
        // Extract `siteSetting` and `footerSetting`
        $siteSetting = $settings->where('setting_type', 'site_setting')->first();
        $footerSetting = $settings->where('setting_type', 'footer_setting')->first();
        
        return response()->json([
            "siteSetting" => $siteSetting,
            "footerSetting" => $footerSetting,
            "message" => "Successfully retrieved",
            "status" => 200
        ]);
        } catch (Exception $e) {
            Log::channel('database')->error('Site Setting  API Error', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->json([
                "message" => "Something went wrong",
                "status" => 500
            ]);
        }
    }


    public function pageData($slug)
    {
        try {
            $pageData = $this->pageService->list()
                ->where('page_data->page_slug', $slug)
                ->where('status', 'active')
                ->first();
            if (empty($pageData)) {
                return response()->json([
                    "message" => "Page Not Found",
                    "status" => 400
                ]);
            } else {

                $pageSectiponData = $this->pageSectionService->list()
                ->where('page_id', $pageData->id)
                ->where('status', 'active')
                ->orderBy('sort_id', 'ASC')
                ->get()
                ->makeHidden(['html_content']); // Hides html_content field
            
            foreach ($pageSectiponData as $pagesection) {
                // Decode `page_section_data` JSON into an array
                $pagesection->page_section_data = json_decode($pagesection->page_section_data, true);
            
                // Fetch section name
                $section = $this->sectionService->sectionList()->where('id', $pagesection->section_id)->first();
                $pagesection->section_name = $section ? $section->section_name : null;
            
                // Fetch section style name
                $sectionStyle = $this->sectionStyleService->sectionStyleList()->where('id', $pagesection->section_style_id)->first();
                $pagesection->section_style_name = $sectionStyle ? $sectionStyle->section_style_name : null;
            }
            $pageData->page_data = json_decode($pageData->page_data, true);

            return response()->json([
                "page_data"=>$pageData,
                "data" => $pageSectiponData,
                "message" => "Successfully retrieved",
                "status" => 200
            ]);
            }
        } catch (Exception $e) {
            Log::channel('database')->error('Site Setting  API Error', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->json([
                "message" => "Something went wrong",
                "status" => 500
            ]);
        }
    }

    public function saveMaintinanceEnquiry(Request $request)
    {
        try {

            $data = [
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'subject' => $request->input('subject'),
                'message' => $request->input('message'),
                'ip_address' => $request->input(key: 'ip_address'),
            ];
            $this->maintinanceEnqueryService->create($data);
           $name= $request->input('first_name'). ' '. $request->input('last_name');
            Mail::to($request->input('email'))->send(new ContactUsMail(
                $name ,
                $request->input('email'),
                $request->input('phone'),
                $request->input('subject'),
                $request->input('message'),
            ));

            return response()->json([
                "message" => "Successfully Send Data",
                "status" => 200
            ]);
        } catch (Exception $e) {
            Log::channel('database')->error('Maintinance Enquiry Style Add', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->json([
                "message" => "Something went wrong",
                "status" => 500
            ]);
        }
    }


  public function latestThreeBlogs()
    {
   
      try {
        $blogs = $this->blogService->list()->with('category','user')->where('status', '1')->orderBy('id', 'DESC')->limit(3)
        ->get() ->makeHidden(['blog_image2', 'image2_alt', 'blog_image3', 'image3_alt', 'blog_short_details2', 'blog_details1','blog_details2']);
        return response()->json([
            "data" => $blogs,
            "message" => "Successfully retrieved",
            "status" => 200
        ]);
    } catch (Exception $e) {
        Log::channel('database')->error('Latest Three Blog API Error', [
            'error' => $e->getMessage(),
            'stack_trace' => $e->getTraceAsString(),
        ]);
        return response()->json([
            "message" => "Something went wrong",
            "status" => 500
        ]);
    }
    }


    public function blogsPaginate()
    {
        try {
            $blogs = $this->blogService->list()
                ->with('category', 'user')
                ->where('status', '1')
                ->orderBy('id', 'DESC')
                ->paginate(11); // Fixed typo and removed limit(3)
            
            return response()->json([
                "data" => $blogs,
                "message" => "Successfully retrieved",
                "status" => 200
            ]);
        } catch (Exception $e) {
            Log::channel('database')->error('Pagignate Blog API Error', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->json([
                "message" => "Something went wrong",
                "status" => 500
            ]);
        }
    }

    public function blogDetails($slug)
    {
        try {
            $blog = $this->blogService->list()
                ->with('category')
                ->where('blog_slug', $slug)
                ->first();
                $newsSetting = $this->settingService->list()->where('setting_type', 'news_setting')->first();
                $newsSetting->setting_data=json_decode($newsSetting->setting_data, true);
                $newsSetting=json_decode($newsSetting, true);
            
            return response()->json([
                "data" => $blog,
                "newsSetting" => $newsSetting,
                "message" => "Successfully retrieved",
                "status" => 200
            ]);
        } catch (Exception $e) {
            Log::channel('database')->error('Blog Detail API Error', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->json([
                "message" => "Something went wrong",
                "status" => 500
            ]);
        }
    }


    public function latestTeam()
    {
        try {
            $teams = $this->teamService->list()
                ->where('status', 'active')
                ->orderBy('id', 'DESC')->limit(8)
                ->get();
            
            return response()->json([
                "data" => $teams,
                "message" => "Successfully retrieved",
                "status" => 200
            ]);
        } catch (Exception $e) {
            Log::channel('database')->error('Latest Team API Error', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->json([
                "message" => "Something went wrong",
                "status" => 500
            ]);
        }
    }

    public function allTeamMember()
    {
        try {
            $teams = $this->teamService->list()
            ->where('status', 'active')
            ->orderBy('id', 'DESC')
            ->get();
            
            return response()->json([
                "data" => $teams,
                "message" => "Successfully retrieved",
                "status" => 200
            ]);
        } catch (Exception $e) {
            Log::channel('database')->error('Team API Error', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->json([
                "message" => "Something went wrong",
                "status" => 500
            ]);
        }
    }
    

    public function helpData()
    {
        try {
            $helpFaqs = $this->helpCategoryService->list()
            ->with('helpFaq')
            ->where('status', '1')
            ->orderBy('category_name', 'ASC')
            ->get();
            foreach($helpFaqs as $helpFaq){
                $helpFaq->question_ount=count($helpFaq->helpFaq);
            }
            
            return response()->json([
                "data" => $helpFaqs,
                "message" => "Successfully retrieved",
                "status" => 200
            ]);
        } catch (Exception $e) {
            Log::channel('database')->error('Faq API Error', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->json([
                "message" => "Something went wrong",
                "status" => 500
            ]);
        }
    }


    public function saveContactEnquiry(Request $request)
    {
        try {

            $this->validateRequest($request, ContactEnquery::validateRules(), ContactEnquery::validateMessages());
            $ipAddress = $request->ip();

            $data = [
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'subject' => $request->input('subject'),
                'message' => $request->input('message'),
                'ip_address' => $ipAddress,
            ];
            $this->contactEnqueryService->create($data);
           $name= $request->input('first_name'). ' '. $request->input('last_name');
            Mail::to($request->input('email'))->send(new ContactUsMail(
                $name ,
                $request->input('email'),
                $request->input('phone'),
                $request->input('subject'),
                $request->input('message'),
            ));

            return response()->json([
                "message" => "Successfully Send Enquery",
                "status" => 200
            ]);
        } catch (Exception $e) {
            Log::channel('database')->error('Section Style Add', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->json([
                "message" => "Something went wrong",
                "status" => 500
            ]);
        }
    }

    public function saveNewsletterAPI(Request $request)
    {
        try {
            $this->validateRequest($request, Subscriber::validateRules(), Subscriber::validateMessages());
            $ipAddress = $request->ip();
            $data = [
                'email' => $request->input('email'),
                'ip_address' => $ipAddress,
            ];
            $exist = $this->subscriberService->list()->where('email', $request->input('email'))->exists();
            
            if (!$exist) {

            $this->subscriberService->create($data);
            Mail::to($request->input('email'))->send(new SubscriberMail(
                $request->input('email'),
            ));
            return response()->json([
                "message" => "Successfully Subscribed",
                "status" => 200
            ]);
        }else{
            return response()->json([
                'message' => 'Email already exists in our subscription.',
                'status' => 409
            ]);
        }
        } catch (Exception $e) {
            Log::channel('database')->error('News Letter', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->json([
                "message" => "Something went wrong",
                "status" => 500
            ]);
        }
    }


    public function portfolioDetails($portSlug)
{
    try {
        $pageSection = $this->pageSectionService->list()
            ->where('section_id', '15')
            ->whereJsonContains('page_section_data->step_data', [['port_slug' => $portSlug]])
            ->first();

        $stepData = null;

        if ($pageSection) {
            $data = json_decode($pageSection->page_section_data, true);
            $stepData = collect($data['step_data'])->firstWhere('port_slug', $portSlug);
        }
        $stepData['created_at'] = date("M d Y", strtotime($pageSection->created_at));
        $pageData = new stdClass();
        $pageData->step_data = $stepData;

        return response()->json([
            "data" => $pageData,
            "message" => "Successfully retrieved",
            "status" => 200
        ]);
    } catch (Exception $e) {
        Log::channel('database')->error('Portfolio Detail API Error', [
            'error' => $e->getMessage(),
            'stack_trace' => $e->getTraceAsString(),
        ]);

        return response()->json([
            "message" => "Something went wrong",
            "status" => 500
        ]);
    }
}


public function helpDetails($slug)
    {
        try {
            $helpDetail = $this->helpFaqService->list()
                ->with('helpCategory')
                ->where('slug', $slug)
                ->first();
          
                $helpRelated = $this->helpFaqService->list()->where('id', '!=', $helpDetail->id)->where('category_id', $helpDetail->category_id)->where('status', 'active')->orderBy('id', 'DESC')->limit(6)->get();

            return response()->json([
                "data" => $helpDetail,
                "helpRelated" => $helpRelated,
                "message" => "Successfully retrieved",
                "status" => 200
            ]);
        } catch (Exception $e) {
            Log::channel('database')->error('Help Detail API Error', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->json([
                "message" => "Something went wrong",
                "status" => 500
            ]);
        }
    }


     public function privacyStyle2()
    {
        try {
            $privacyPolicy = $this->privacyPolicyCategoryService->list()
            ->with('privacyPolicies')
            ->where('status', '1')
            ->orderBy('category_name', 'ASC')
            ->get();
         
            
            return response()->json([
                "data" => $privacyPolicy,
                "message" => "Successfully retrieved",
                "status" => 200
            ]);

        } catch (Exception $e) {
            Log::channel('database')->error('Privacy API Error', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->json([
                "message" => "Something went wrong",
                "status" => 500
            ]);
        }
    }
    
    //for latest six jobs//
public function latestSixJobs()
    {
         try {
             $latestSixJobs = $this->postJobService->list()
             ->with('company', 'department', 'location')
             ->where('status', operator: 'active')
             ->orderBy('id', 'DESC')->limit(6)
             ->get()
             ->makeHidden(['description']); // Hides html_content field
;
                  
                    
                    return response()->json([
                        "data" => $latestSixJobs,
                        "message" => "Latest 6 Jobs retrieved",
                        "status" => 200
                    ]);
          } catch (Exception $e) {
                    Log::channel('database')->error('Latest Six Jobs API Error', [
                        'error' => $e->getMessage(),
                        'stack_trace' => $e->getTraceAsString(),
                    ]);
                    return response()->json([
                        "message" => "Something went wrong",
                        "status" => 500
                    ]);
                }
    }
    
public function allJobs(Request $request)
    {
         try {
                 $query = $this->postJobService->list()
                    ->with('company', 'department', 'location')
                    ->where('status', 'active');
                
                    // Apply filters
                    if ($request->has('title') && $request->title != '') {
                        $query->where('title', 'like', '%' . $request->title . '%');
                    }
                    
                    if ($request->has('location_id') && $request->location_id != '') {
                        $query->where('location_id', $request->location_id);
                    }
                    
                    if ($request->has('salary_min') && $request->salary_min != '') {
                        $query->where('minimum_salary', '>=', $request->salary_min);
                    }
                    
                    if ($request->has('salary_max') && $request->salary_max != '') {
                        $query->where('maximum_salary', '<=', $request->salary_max);
                    }
                    
                    if ($request->has('type') && $request->type != '') {
                        $query->where('type', $request->type);
                    }
                    
                    // Finally apply ordering and pagination
                    $allJobsPagignate = $query->orderBy('id', 'DESC')->paginate(2);

                    return response()->json([
                        "data" => $allJobsPagignate,
                        "message" => "All Jobs pagignate Jobs retrieved",
                        "status" => 200
                    ]);
          } catch (Exception $e) {
                    Log::channel('database')->error('All Jobs pagignate Jobs API Error', [
                        'error' => $e->getMessage(),
                        'stack_trace' => $e->getTraceAsString(),
                    ]);
                    return response()->json([
                        "message" => "Something went wrong",
                        "status" => 500
                    ]);
                }
      }
    
    
public function jobDetail($slug)
    {
         try {
             $jobDetails = $this->postJobService->list()->with('company', 'department', 'location')->where('job_slug', $slug)->first(); // Hides html_content field
             $relatedJobs = $this->postJobService->list()
             ->with('company', 'department', 'location')
             ->where('id', '!=', $jobDetails->id)
            // ->where('department_id', $jobDetails->department_id) // Adjusted from category_id to department_id
             ->where('status', 'active')
             ->orderBy('id', 'DESC')
             ->limit(6)
             ->get()
             ->makeHidden(['description']);
            
            return response()->json([
                "data" => $jobDetails,
                "related_jobs" => $relatedJobs,
                "message" => "Job Detail API retrieved",
                "status" => 200
            ]);
          } catch (Exception $e) {
                    Log::channel('database')->error('Latest Six Jobs API Error', [
                        'error' => $e->getMessage(),
                        'stack_trace' => $e->getTraceAsString(),
                    ]);
                    return response()->json([
                        "message" => "Something went wrong",
                        "status" => 500
                    ]);
          }
    }
    
    public function allDepartment()
    {
         try {
             $departments = $this->departmentService->list()->where('status', 'active')->orderBy('id', 'DESC')->limit(12)->get(); // Hides html_content field
            return response()->json([
                "data" => $departments,
                "message" => "Job Detail API retrieved",
                "status" => 200
            ]);
          } catch (Exception $e) {
                    Log::channel('database')->error('Latest Six Jobs API Error', [
                        'error' => $e->getMessage(),
                        'stack_trace' => $e->getTraceAsString(),
                    ]);
                    return response()->json([
                        "message" => "Something went wrong",
                        "status" => 500
                    ]);
          }
    }


public function checkLoginApplicant(Request $request)
{
    try {
        // Get the authenticated applicant
        $user =Applicant::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'message' => 'Unauthorized',
                'status' => 401
            ], 401);
        }

        // Check if the login token is expired
        if (!$user->login_token || Carbon::now()->greaterThan($user->login_token_expires_at)) {
            return response()->json([
                'message' => 'Login token expired',
                'status' => 401
            ], 401);
        }

        // Token is valid
        return response()->json([
            'message' => 'Login token is valid',
            'status' => 200,
            'applicant' => [
                'id' => $user->id,
                'email' => $user->email,
                'name' => $user->name,
            ]
        ]);

    } catch (Exception $e) {
        Log::channel('database')->error('Login Token Check Error', [
            'error' => $e->getMessage(),
            'stack_trace' => $e->getTraceAsString(),
        ]);

        return response()->json([
            'message' => 'Something went wrong',
            'status' => 500
        ]);
    }
}


   public function allLocationsData()
    {
         try {
             $locations = $this->locationService->list()->get()
                         ->makeHidden(['short_description']);
            return response()->json([
                "data" => $locations,
                "message" => "location API retrieved",
                "status" => 200
            ]);
          } catch (Exception $e) {
                    Log::channel('database')->error('location API Error', [
                        'error' => $e->getMessage(),
                        'stack_trace' => $e->getTraceAsString(),
                    ]);
                    return response()->json([
                        "message" => "Something went wrong",
                        "status" => 500
                    ]);
          }
    }


  
}
