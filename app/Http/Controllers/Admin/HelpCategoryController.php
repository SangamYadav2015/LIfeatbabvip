<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HelpCategory;
use Illuminate\Http\Request;
use App\Services\HelpCategoryService;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Traits\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
class HelpCategoryController extends Controller
{
    use ValidatesRequests;
    protected $helpCategoryService;

    public function __construct(
        HelpCategoryService $helpCategoryService,
    ) {
        $this->helpCategoryService = $helpCategoryService;
    }

    public function index()
    {
        try {
            $data['pageTitle'] = 'Admin Help Category List';
            $data['pageDescription'] = 'BabVip CMS Admin Help Category List';
            $helpCategories = $this->helpCategoryService->list()->paginate(10);
            return view('admin.help-category.index', compact('data', 'helpCategories'));
        } catch (Exception $e) {
            Log::channel('database')->error('Help Category retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function add()
    {
        try {
            $data['pageTitle'] = 'Admin Add Help Categry';
            $data['pageDescription'] = 'BabVip CMS Add Help Categrory';
            return view('admin.help-category.add', compact('data'));
        } catch (Exception $e) {
            Log::channel('database')->error('Help Category add  failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function checkHelpCategory(Request $request)
    {
        try {
            $categoryName = $request->category_name;
            $exists = $this->helpCategoryService->list()->where('category_name', $categoryName)->exists();
            if ($exists) {
                return response()->json(['exists' => true], 200);
            } else {
                return response()->json(['exists' => false], 200);
            }
        } catch (Exception $e) {
            Log::channel('database')->error('Help Category Check Name failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }


    public function helpCatrgoryStore(Request $request)
    {
        try {
            $this->validateRequest($request, HelpCategory::validateRules(), HelpCategory::validateMessages());
       
            $data = $request->all();
            $storeData = [
                "category_name" => $request->category_name,
                "status" => $request->status,
            ];
            $this->helpCategoryService->create($storeData);
            return redirect('admin/helpcategory')->with('success', 'Help Category created successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('Page Add', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function updateHelpCategoryStatus(Request $request)
    {
        try {
            $category_id = $request->category_id;
            $data = $request->all();
            $this->helpCategoryService->update($data, $category_id);
            return response()->json(['message' => 'Help category status updated successfully', 'status' => 200]);
        } catch (Exception $e) {
            Log::channel('database')->error('Help category status change failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function editHelpCategory($id)
    {
        try {
            $data['pageTitle'] = 'Admin Page Edit';
            $data['pageDescription'] = 'BabVip CMS Admin Help Category Edit';
            $categoryData = $this->helpCategoryService->singleDataFindId($id);
            return view('admin.help-category.edit', compact('data', 'categoryData'));
        } catch (Exception $e) {
            Log::channel('database')->error('Help edit retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function updateHelpCategory(Request $request, $id)
    {
        try {
            $data = $request->all();
            $this->helpCategoryService->update($data, $id);
            return redirect('admin/helpcategory')->with('success', 'Help category updated successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('help category update change failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function deleteHelpCategory($id){
        try {
            $this->helpCategoryService->delete($id);
            return redirect('admin/helpcategory')->with('success', 'Help category deleted successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('Help category delete', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

}
