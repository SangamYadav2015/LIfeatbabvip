<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blogcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Traits\ValidatesRequests;
use App\Models\Menu;
use App\Services\BlogCategoryService;

class BlogCategoryController extends Controller
{
    use ValidatesRequests;

    protected $blogcategoryservice;
    public function __construct(
        BlogCategoryService $blogcategoryservice,
    ) {
        $this->blogcategoryservice = $blogcategoryservice;
    }
    public function index()
    {
        try {
            $data['pageTitle'] = 'Admin Blog Categry List';
            $data['pageDescription'] = 'BabVip CMS Blog Categrory List';
            $blogCategory = $this->blogcategoryservice->list()->paginate(10);
            return view('admin.blog-category.index', compact('data', 'blogCategory'));
        } catch (Exception $e) {
            Log::channel('database')->error('blogCategory retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function add()
    {
        try {
            $data['pageTitle'] = 'Admin Add News Categry List';
            $data['pageDescription'] = 'BabVip CMS Add News Categrory';
            return view('admin.blog-category.add', compact('data'));
        } catch (Exception $e) {
            Log::channel('database')->error('blogCategory add  failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }
    
    public function checknewsCategory(Request $request)
    {
        try {
            $categoryName = $request->category_name;
            $exists = $this->blogcategoryservice->list()->where('category_name', $categoryName)->exists();
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

    
    public function blogCatrgoryStore(Request $request)
    {
        try {
            $this->validateRequest($request, Blogcategory::validateRules(), Blogcategory::validateMessages());
       
            $data = $request->all();
            $categorySlug = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($request->category_name));
            $storeData = [
                "category_name" => $request->category_name,
                "category_slug" => $categorySlug,
                "status" => $request->status,
            ];
            $this->blogcategoryservice->create($storeData);
            return redirect('admin/blogcatrgorylist')->with('success', 'News created successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('Page Add', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function updateBlogCategoryStatus(Request $request)
    {
        try {
            $category_id = $request->category_id;
            $data = $request->all();
            $this->blogcategoryservice->update($data, $category_id);
            return response()->json(['message' => 'page status updated successfully', 'status' => 200]);
        } catch (Exception $e) {
            Log::channel('database')->error('page status change failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function editBlogCategory($id)
    {
        try {
            $data['pageTitle'] = 'Admin Page Edit';
            $data['pageDescription'] = 'BabVip CMS Admin News Category Edit';
            $categoryData = $this->blogcategoryservice->singleDataFindId($id);
            return view('admin.blog-category.edit', compact('data', 'categoryData'));
        } catch (Exception $e) {
            Log::channel('database')->error('News edit retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }


    public function updateblogCategory(Request $request, $id)
    {
        try {
            $data = $request->all();
            $categorySlug = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($request->category_name));
            $data['category_slug']= $categorySlug;
            $this->blogcategoryservice->update($data, $id);
            return redirect('admin/blogcatrgorylist')->with('success', 'News category updated successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('News update change failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }
    
    public function deleteBlogCategory($id){
        try {
            $this->blogcategoryservice->delete($id);
            return redirect('admin/blogcatrgorylist')->with('success', 'News category deleted successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('News category delete', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

}
