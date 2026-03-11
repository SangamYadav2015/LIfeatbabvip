<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

use App\Services\MenuService;
use App\Services\PageService;
use App\Services\PageSectionService;
use App\Services\SettingService;
use App\Services\HelpFaqService;
use App\Services\BlogService;
use stdClass;
use App\Services\PostJobService;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Models\Department; 
use App\Models\PostJob; 
use App\Models\Location; 
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;



class SiteController extends Controller
{
    protected $menuService;
    protected $pageService;
    protected $pageSectionService;
    protected $settingService;
    protected $blogService;
    protected $helpFaqService;
    protected $postJobService;

    public function __construct(
        MenuService $menuService,
        PageService $pageService,
        PageSectionService $pageSectionService,
        SettingService $settingService,
        BlogService $blogService,
        HelpFaqService $helpFaqService,
        PostJobService $postJobService // Add this line


    ) {
        $this->menuService = $menuService;
        $this->pageService = $pageService;
        $this->pageSectionService = $pageSectionService;
        $this->settingService = $settingService;
        $this->blogService = $blogService;
        $this->helpFaqService = $helpFaqService;
        $this->postJobService = $postJobService; // Assign the PostJobService
    }

    public function home()
    {
        try {
        $siteSetting = $this->settingService->list()->where('setting_type', 'site_setting')->first();
        $footerSetting = $this->settingService->list()->where('setting_type', 'footer_setting')->first();
        $pageData = $this->pageService->list()
        ->where('status', 'active')->where('is_home', true)
        ->first(); 
        if(empty( $pageData )) {
            return view('comming-soon', compact('siteSetting','footerSetting'));
        }else{
        $pageSectiponData = $this->pageSectionService->list()->where('page_id', $pageData->id)
        ->where('status', 'active')
        ->orderBy('sort_id', 'ASC')
        ->get();
        return view('site.sitepage', compact('pageData','pageSectiponData','siteSetting', 'footerSetting'));
        }
    } catch (Exception $e) {
        Log::channel('database')->error('Page File Content Get', [
            'error' => $e->getMessage(),
            'stack_trace' => $e->getTraceAsString(),
        ]);
        return response()->view('errors.500', [], 500);
    }
    }
    public function show($slug)
    {
      try {
        $siteSetting = $this->settingService->list()->where('setting_type', 'site_setting')->first();
        $footerSetting = $this->settingService->list()->where('setting_type', 'footer_setting')->first();
        $pageData = $this->pageService->list()
        ->where('page_data->page_slug', $slug)
        ->where('status', 'active')
        ->first(); 
        if(empty( $pageData )) {
            return response()->view('errors.400', [], 400);
        }else{
        $pageSectiponData = $this->pageSectionService->list()->where('page_id', $pageData->id)
        ->where('status', 'active')
        ->orderBy('sort_id', 'ASC')
        ->get(); 
        return view('site.sitepage', compact('pageData','pageSectiponData', 'siteSetting', 'footerSetting'));
        }
    } catch (Exception $e) {
        Log::channel('database')->error('Page File Content Get', [
            'error' => $e->getMessage(),
            'stack_trace' => $e->getTraceAsString(),
        ]);
        return response()->view('errors.500', [], 500);
    }
    }

    public function blogDetails($slug){
        try {
            $siteSetting = $this->settingService->list()->where('setting_type', 'site_setting')->first();
            $footerSetting = $this->settingService->list()->where('setting_type', 'footer_setting')->first();
            $newsSetting = $this->settingService->list()->where('setting_type', 'news_setting')->first();

            $blog = $this->blogService->list()->where('blog_slug', $slug)->first();
            $bloglatest = $this->blogService->list()->where('id','!=', $blog->id)->where('status','1')->orderBy('id','DESC')->get();
            $headData=['meta_title'=> $blog->blog_title, "meta_description"=> $blog->blog_short_details1 ];
            $jsonString = json_encode($headData);
            $pageData = new stdClass();
            $pageData->page_data = $jsonString;

            return view('site.blogDetails',['pageData' => $pageData], compact( 'siteSetting', 'footerSetting','newsSetting', 'blog','bloglatest'));
        } catch (Exception $e) {
            Log::channel('database')->error('Page File Content Get', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }


    public function helpDetails($slug){
        try {
            $siteSetting = $this->settingService->list()->where('setting_type', 'site_setting')->first();
            $footerSetting = $this->settingService->list()->where('setting_type', 'footer_setting')->first();
            $help = $this->helpFaqService->list()->where('slug', $slug)->first();
            $helpRelated = $this->helpFaqService->list()->where('id','!=', $help->id)->where('category_id', $help->category_id)->where('status','active')->orderBy('id','DESC')->limit(6)->get();
            $headData=['meta_title'=> $help->question, "meta_description"=> $help->question ];
            $jsonString = json_encode($headData);
            $pageData = new stdClass();
            $pageData->page_data = $jsonString;

            return view('site.help-center/help-details',['pageData' => $pageData], compact( 'siteSetting', 'footerSetting', 'help','helpRelated'));
        } catch (Exception $e) {
            Log::channel('database')->error('help center Content Get', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function helpAutoComplete(Request $request)
    {
        $query = $request->get('query');

        // Fetch matching results from the database
        $results = $this->helpFaqService->list()->where('question', 'LIKE', "%{$query}%")
                            ->limit(10) // Limit the number of results
                            ->get();

        // Return the results as JSON
        return response()->json($results);
    }



    public function jobDetails($slug)
    {
        try {
            // Fetch site and footer settings
            $siteSetting = $this->settingService->list()->where('setting_type', 'site_setting')->first();
            $footerSetting = $this->settingService->list()->where('setting_type', 'footer_setting')->first();

            // Fetch job details using slug
            $job = $this->postJobService->list()->where('job_slug', $slug)->first();

            // If no job is found, throw 404
            if (!$job) {
                abort(404, 'Job not found');
            }

            // Fetch related jobs from the same category
            $relatedJobs = $this->postJobService->list()
            ->where('id', '!=', $job->id)
            ->where('department_id', $job->department_id) // Adjusted from category_id to department_id
            ->where('status', 'active')
            ->orderBy('id', 'DESC')
            ->limit(6)
            ->get();

            // Prepare meta data
            $headData = ['meta_title' => $job->title, 'meta_description' => $job->description];
            $jsonString = json_encode($headData);
            $pageData = new stdClass();
            $pageData->page_data = $jsonString;

            // Return the view with job details, related jobs, and settings
            return view('site.job-details', ['pageData' => $pageData], compact('siteSetting', 'footerSetting', 'job', 'relatedJobs'));
        } catch (Exception $e) {
            // Log the error
            Log::channel('database')->error('Job details retrieval error', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);

            // Return 500 error view
            return response()->view('errors.500', [], 500);
        }
    }
  
    public function seeAllJobsWithFilter(Request $request)
    {
        try {
            // Fetch site and footer settings
            $siteSetting = $this->settingService->list()->where('setting_type', 'site_setting')->first();
            $footerSetting = $this->settingService->list()->where('setting_type', 'footer_setting')->first();
    
            // Fetch all departments
            $departments = Department::all(); // Assuming you have a Department model
            $locations = Location::all();
            // Build the query for job listings
            $query = PostJob::query();
           
            // Apply filters to the query
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
    
          
    
            // Fetch filtered jobs with pagination
            $jobs = $query->where('status', 'active')
                ->orderBy('created_at', 'DESC')
                ->paginate(10); // Adjust pagination as needed
    
            // Prepare meta data for SEO
            $headData = ['meta_title' => 'All Jobs', 'meta_description' => 'Browse all available job opportunities.'];
            $jsonString = json_encode($headData);
            $pageData = new stdClass();
            $pageData->page_data = $jsonString;
    
            // If it's an AJAX request, return the filtered jobs as HTML
            if ($request->ajax()) {
                $jobsHTML = view('site.see_all_jobs', compact('jobs'))->render();
                return response()->json(['jobsHTML' => $jobsHTML]);
            }
    
            // Return the main view with jobs list, settings, and departments
            return view('site.see_all_jobs', [
                'pageData' => $pageData,
                'siteSetting' => $siteSetting,
                'footerSetting' => $footerSetting,
                'jobs' => $jobs,
                
                'locations' => $locations
            ]);
        } catch (Exception $e) {
            // Log the error
            Log::channel('database')->error('All jobs retrieval error', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
    
            // Return 500 error view
            return response()->view('errors.500', [], 500);
        }
    }

   
    
    public function filter(Request $request)
    {
        $query = PostJob::query(); // Start with the base query

         $siteSetting = $this->settingService->list()->where('setting_type', 'site_setting')->first();
            $footerSetting = $this->settingService->list()->where('setting_type', 'footer_setting')->first();

        $headData = ['meta_title' => 'All Jobs', 'meta_description' => 'Browse all available job opportunities.'];
        $jsonString = json_encode($headData);
        $pageData = new stdClass();
        $pageData->page_data = $jsonString;
    
        // Apply filters based on the request
        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }
    
       
    
        if ($request->filled('location_id')) {
            $query->where('location_id', $request->location_id);
        }
    
        if ($request->filled('salary_min')) {
            $query->where('minimum_salary', '>=', $request->salary_min);
        }
    
        if ($request->filled('salary_max')) {
            $query->where('maximum_salary', '<=', $request->salary_max);
        }
    
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
    
        $jobs = $query->get();  // Get the filtered jobs
    
        // If the request is AJAX, return only the filtered job listings as HTML
        if ($request->ajax()) {
            $jobsHTML = view('site.partialjoblist', compact('jobs'))->render(); // Render the updated job list view
            return response()->json(['jobsHTML' => $jobsHTML]);
        }
    
        // For non-AJAX requests, return the full page
        return view('site.partialjoblist', compact('jobs'));
    }
    
    public function addToWishlist(PostJob $job)
    {
        $applicantId = Auth::guard('applicant')->id(); // Get the logged-in applicant's ID

        // Check if the job is already in the wishlist
        $existingWishlistItem = Wishlist::where('applicant_id', $applicantId)->where('job_id', $job->id)->first();

        if (!$existingWishlistItem) {
            // Add to the wishlist
            Wishlist::create([
                'applicant_id' => $applicantId,
                'job_id' => $job->id,
            ]);

            return back()->with('success', 'Job added to your wishlist!');
        }

        return back()->with('error', 'This job is already in your wishlist.');
    }

    // Remove job from wishlist
    public function removeFromWishlist(PostJob $job)
    {
        $applicantId = Auth::guard('applicant')->id(); // Get the logged-in applicant's ID

        // Find and delete the wishlist item
        $wishlistItem = Wishlist::where('applicant_id', $applicantId)->where('job_id', $job->id)->first();
        if ($wishlistItem) {
            $wishlistItem->delete();

            return back()->with('success', 'Job removed from your wishlist.');
        }

        return back()->with('error', 'Job not found in your wishlist.');
    }
    
}
