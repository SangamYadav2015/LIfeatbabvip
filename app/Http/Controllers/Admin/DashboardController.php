<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\BlogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Services\PageService;
use App\Services\UserService;
use App\Services\DepartmentService;
use App\Services\LogsServices;
use App\Services\ContactEnqueryService;
use App\Services\SubscriberService;
use App\Services\MaintinanceEnqueryService;
use Illuminate\Support\Facades\DB;
use App\Services\ApplicantService;
use App\Services\PostJobService;


class DashboardController extends Controller
{
    protected $pageService;
    protected $userService;
    protected $departmentService;
    protected $logsServices;
    protected $contactEnqueryService;
    protected $subscriberService;
    protected $maintinanceEnqueryService;
    protected $blogService;
    protected $postJobService;
    public function __construct(
        PageService $pageService,
        UserService $userService,
        DepartmentService $departmentService,
        LogsServices $logsServices,
        ContactEnqueryService $contactEnqueryService,
        SubscriberService $subscriberService,
        MaintinanceEnqueryService $maintinanceEnqueryService,
        BlogService $blogService,
       ApplicantService $applicantService,
       PostJobService $postJobService
    ) {
        $this->pageService = $pageService;
        $this->userService =  $userService;
        $this->departmentService =  $departmentService;
        $this->logsServices = $logsServices;
        $this->contactEnqueryService = $contactEnqueryService;
        $this->subscriberService = $subscriberService;
        $this->maintinanceEnqueryService = $maintinanceEnqueryService;
        $this->blogService =$blogService;
                $this->applicantService = $applicantService;
                $this->postJobService = $postJobService;

    }
    public function index()
    {
        try {
            
            $data['pageTitle'] = 'Admin Dashboard';
            $data['pageDescription'] = 'BabVip CMS Admin Dashboard';

            $totalPages = $this->pageService->list()->count();
            $activePages = $this->pageService->list()->where('status', 1)->count();
            $inActivePages = $this->pageService->list()->where('status', 0)->count();

            $totalUser = $this->userService->list()->count();
            $activeUser = $this->userService->list()->where('status', 1)->count();
            $inActiveUser = $this->userService->list()->where('status', 0)->count();
            
            $logs = $this->logsServices->list()->where('status', 'New')->get();
            $contactEnqueries = $this->contactEnqueryService->list()->get();
            $subscriberEnqueries = $this->subscriberService->list()->get();
            $maintinanceEnqueries = $this->maintinanceEnqueryService->list()->get();

            $totalNews = $this->blogService->list()->count();
            $activeNews = $this->blogService->list()->where('status', 1)->count();
            $inActiveNews = $this->blogService->list()->where('status', 0)->count();
$totalApplicants = $this->applicantService->getTotalApplicants();
$totalPostJobs = $this->postJobService->getTotalPostJobs();


            return view('admin.dashboard', compact('totalPages', 'activePages', 'inActivePages','totalUser','activeUser','inActiveUser','logs','contactEnqueries','subscriberEnqueries', 'totalNews','activeNews','inActiveNews',
       'totalApplicants','totalPostJobs', 'maintinanceEnqueries'));
        } catch (Exception $e) {
            Log::channel('database')->error('User retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }
}
