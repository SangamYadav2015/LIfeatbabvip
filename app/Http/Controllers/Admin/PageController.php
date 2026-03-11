<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Services\PageService;
use App\Services\MenuService;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Traits\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class PageController extends Controller
{
    use ValidatesRequests;
    protected $pageService;
    protected $menuService;

    public function __construct(
        PageService $pageService,
        MenuService $menuService,
    ) {
        $this->pageService = $pageService;
        $this->menuService = $menuService;
    }

    public function index()
    {
        try {
            $data['pageTitle'] = 'Admin Section Style List';
            $data['pageDescription'] = 'BabVip CMS Admin Section Style List';
            $pages = $this->pageService->list()->orderBy('id','ASC')->paginate(10);
            return view('admin.page.index', compact('data', 'pages'));
        } catch (Exception $e) {
            Log::channel('database')->error('Page retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function checkPageMenu(Request $request)
    {
        try {
            $menuId = $request->menu_id;
            $exists = $this->pageService->list()->where('menu_id', $menuId)->exists();
            if ($exists) {
                return response()->json(['exists' => true], 200);
            } else {
                return response()->json(['exists' => false], 200);
            }
        } catch (Exception $e) {
            Log::channel('database')->error('Page retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }


    public function addPage()
    {
        try {

            $data['pageTitle'] = 'Admin Create Create Page';
            $data['pageDescription'] = 'BabVip CMS Admin Create Page';
            $menuData = $this->menuService->list()->with('childrenRecursive')->whereNull('parent_id')->whereNull('menu_slug')->where('status', 'active')->get();
            return view('admin.page.add', compact('data', 'menuData'));
        } catch (Exception $e) {
            Log::channel('database')->error('Section Style Add', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function storePage(Request $request)
    {
        try {
            $this->validateRequest($request, Page::validateRules(), Page::validateMessages());

            $data = $request->all();
            if (!empty($data['og_graph_image'])) {
                $ogGraphImage = $this->upload($data['og_graph_image']);
                $data['og_graph_image'] = $ogGraphImage;               
            } 
            $storeData = [
                "menu_id" => $request->menu_id,
                "status" => $request->status,
                "page_data" => json_encode($data, true),
            ];
            $this->pageService->create($storeData);
            return redirect('admin/pagelist')->with('success', 'Page created successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('Page Add', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function pageChangeStatus(Request $request)
    {

        try {
            $id = $request->id;
            $data = array(
                'status' => $request->status,
            );
            $this->pageService->update($data, $id);
            return response()->json(['message' => 'page status updated successfully', 'status' => 200]);
        } catch (Exception $e) {
            Log::channel('database')->error('page status change failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }
    public function editPage($id)
    {
        try {
            $data['pageTitle'] = 'Admin Page Edit';
            $data['pageDescription'] = 'BabVip CMS Admin Page Edit';
            $menuData = $this->menuService->list()->with('childrenRecursive')->whereNull('parent_id')->whereNull('menu_slug')->where('status', 'active')->get();
            $pageData = $this->pageService->singleDataFindId($id);
            return view('admin.page.edit', compact('data', 'pageData', 'menuData'));
        } catch (Exception $e) {
            Log::channel('database')->error('page edit retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }


    public function updatePage($id, Request $request){
        try {
            $this->validateRequest($request, Page::validateRules(), Page::validateMessages());

            $data = $request->all();
            if (!empty($data['og_graph_image'])) {
                $ogGraphImage = $this->upload($data['og_graph_image']);
                $data['og_graph_image'] = $ogGraphImage;          
                $this->deleteImage($request->og_graph_image_old);
            }else{
                $data['og_graph_image'] =$request->og_graph_image_old;
             }
            $storeData = [
                "menu_id" => $request->menu_id,
                "status" => $request->status,
                "page_data" => json_encode($data, true),
            ];
            $this->pageService->update($storeData, $id);
            return redirect('admin/pagelist')->with('success', 'Page updated successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('Page Add', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }
    public function deletePage($id)
    {
        try {
            $this->pageService->delete($id);
            return redirect('admin/pagelist')->with('success', 'Page deleted successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('page delete', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function upload(UploadedFile $file)
    {
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('uploads', $filename, 'public');
        return $filename;
    }
    public function deleteImage($filename)
    {
        $filePath = 'public/uploads/' . $filename;
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
    }
}
