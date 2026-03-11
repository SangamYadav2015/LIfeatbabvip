<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicyCategory;
use Illuminate\Http\Request;
use App\Services\PrivacyPolicyCategoryService;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Traits\ValidatesRequests;
use Illuminate\Support\Facades\Auth;

class PrivacyPolicyCategoryController extends Controller
{
    
    use ValidatesRequests;
    protected $privacyPolicyCategoryService;

    public function __construct(
        PrivacyPolicyCategoryService $privacyPolicyCategoryService,
    ) {
        $this->privacyPolicyCategoryService = $privacyPolicyCategoryService;
    }

    public function index()
    {
        try {
            $data['pageTitle'] = 'Admin Privacy Policy Category List';
            $data['pageDescription'] = 'BabVip CMS Admin Privacy Policy Category List';
            $categoriesData = $this->privacyPolicyCategoryService->list()->paginate(10);
            return view('admin.privacy-policy-category.index', compact('data', 'categoriesData'));
        } catch (Exception $e) {
            Log::channel('database')->error('Privacy Policy Category retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function add()
    {
        try {
            $data['pageTitle'] = 'Admin Add Privacy Policy Category';
            $data['pageDescription'] = 'BabVip CMS Add Privacy Policy Categrory';
            return view('admin.privacy-policy-category.add', compact('data'));
        } catch (Exception $e) {
            Log::channel('database')->error('Privacy Policy Category add  failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function checkPrivacyPolicyCategory(Request $request)
    {
        try {
            $categoryName = $request->category_name;
            $exists = $this->privacyPolicyCategoryService->list()->where('category_name', $categoryName)->exists();
            if ($exists) {
                return response()->json(['exists' => true], 200);
            } else {
                return response()->json(['exists' => false], 200);
            }
        } catch (Exception $e) {
            Log::channel('database')->error('Privacy Policy Category Check Name failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }


    public function privacyPolicyCatrgoryStore(Request $request)
    {
        try {
            $this->validateRequest($request, PrivacyPolicyCategory::validateRules(), PrivacyPolicyCategory::validateMessages());
       
            $data = $request->all();
            $storeData = [
                "category_name" => $request->category_name,
                "status" => $request->status,
            ];
            $this->privacyPolicyCategoryService->create($storeData);
            return redirect('admin/privacypolicycategory')->with('success', 'Privacy Policy Category created successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('Page Add', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function updatePrivacyPolicyCategoryStatus(Request $request)
    {
        try {
            $category_id = $request->category_id;
            $data = $request->all();
            $this->privacyPolicyCategoryService->update($data, $category_id);
            return response()->json(['message' => 'Privacy Policy Category status updated successfully', 'status' => 200]);
        } catch (Exception $e) {
            Log::channel('database')->error('Privacy Policy Category status change failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function editPrivacyPolicyCategory($id)
    {
        try {
            $data['pageTitle'] = 'Admin Page Edit';
            $data['pageDescription'] = 'BabVip CMS Admin Privacy Policy Category Edit';
            $categoryData = $this->privacyPolicyCategoryService->singleDataFindId($id);
            return view('admin.privacy-policy-category.edit', compact('data', 'categoryData'));
        } catch (Exception $e) {
            Log::channel('database')->error('Privacy Policy edit retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function updatePrivacyPolicyCategory(Request $request, $id)
    {
        try {
            $data = $request->all();
            $this->privacyPolicyCategoryService->update($data, $id);
            return redirect('admin/privacypolicycategory')->with('success', 'Privacy Policy Category updated successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('Privacy Policy Category update change failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function deletePrivacyPolicyCategory($id){
        try {
            $this->privacyPolicyCategoryService->delete($id);
            return redirect('admin/privacypolicycategory')->with('success', 'Privacy Policy Category deleted successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('Privacy Policy Category delete', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }
}
