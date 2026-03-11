<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Traits\ValidatesRequests;
use App\Models\PrivacyPolicy;
use App\Services\PrivacyPolicyService;
use App\Services\PrivacyPolicyCategoryService;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class PrivacyPolicyController extends Controller
{
    use ValidatesRequests;

    protected $privacyPolicyService;
    protected $privacyPolicyCategoryService;
    public function __construct(
        PrivacyPolicyService $privacyPolicyService,
        PrivacyPolicyCategoryService $privacyPolicyCategoryService,

    ) {
        $this->privacyPolicyService = $privacyPolicyService;
        $this->privacyPolicyCategoryService = $privacyPolicyCategoryService;
     }

     public function index()
     {
         try {
             $data['pageTitle'] = 'Admin Privacy policy List';
             $data['pageDescription'] = 'BabVip CMS Admin Privacy policy List';
             $privacyPolicy = $this->privacyPolicyService->list()->with('category')->paginate(10);
             return view('admin.privacy-policy.index', compact('data', 'privacyPolicy'));
         } catch (Exception $e) {
             Log::channel('database')->error('Admin Privacy policy retrieval failed', [
                 'error' => $e->getMessage(),
                 'stack_trace' => $e->getTraceAsString(),
             ]);
             return response()->view('errors.500', [], 500);
         }
     }

     public function updatePrivacyPolicyStatus(Request $request)
     {
         try {
             $id = $request->id;
             $data = array(
                 'status' => $request->status,
             );
             $this->privacyPolicyService->update($data, $id);
             return response()->json(['message' => 'Privacy policy status updated successfully', 'status' => 200]);
         } catch (Exception $e) {
             Log::channel('database')->error('Privacy policy change failed', [
                 'error' => $e->getMessage(),
                 'stack_trace' => $e->getTraceAsString(),
             ]);
             return response()->view('errors.500', [], 500);
         }
     }
 

     public function add()
    {
        try {
            $data['pageTitle'] = 'Admin Add Privacy policy Questions';
            $data['pageDescription'] = 'BabVip CMS Add Privacy policy Questions';
            $privacyCategory = $this->privacyPolicyCategoryService->list()->where('status', '1')->orderBy('category_name','ASC')->get();
            return view('admin.privacy-policy.add', compact('data', 'privacyCategory'));
        } catch (Exception $e) {
            Log::channel('database')->error('Privacy policy Questions add  failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function privacyPolicyStore(Request $request)
    {
        try {
                        $data = $request->all();


            $this->validateRequest($request, PrivacyPolicy::validateRules(), PrivacyPolicy::validateMessages());

            $this->privacyPolicyService->create($data);
            return redirect('admin/privacypolicylist')->with('success', 'Content created successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('Privacy policy Add', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function editPrivacyPolicy($id)
    {
        try {
            $data['pageTitle'] = 'Admin Edit Privacy policy';
            $data['pageDescription'] = 'BabVip CMS Edit Privacy policy';
            $privacyCategory = $this->privacyPolicyCategoryService->list()->where('status', '1')->orderBy('category_name','ASC')->get();
            $privacy = $this->privacyPolicyService->singleDataFindId($id);
            return view('admin.privacy-policy.edit', compact('data', 'privacyCategory', 'privacy'));
        } catch (Exception $e) {
            Log::channel('database')->error('Privacy policy edit failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function updateprivacypolicylog(Request $request, $id)
    {
        try {
            $this->validateRequest($request, PrivacyPolicy::validateRules(), PrivacyPolicy::validateMessages());
            $data = $request->all();
            $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $request->question);
            $data['slug']= $slug;            
            $this->privacyPolicyService->update($data, $id);
            return redirect('admin/privacypolicylist')->with('success', 'Privacy policy updated successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('Privacy policy update', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }


    public function deletePrivacyPolicy($id)
    {
        try {
            $this->privacyPolicyService->delete($id);
            return redirect('admin/privacypolicylist')->with('success', 'Privacy policy deleted successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('Privacy policy delete', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }


}
