<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Traits\ValidatesRequests;
use App\Models\Blogs;
use App\Models\Settings;
use App\Services\BlogService;
use App\Services\BlogCategoryService;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Services\SettingService;
use Carbon\Carbon;
class BlogController extends Controller
{
    use ValidatesRequests;

    protected $blogService;
    protected $blogcategoryservice;
    protected $settingService;

    public function __construct(
        BlogService $blogService,
        BlogCategoryService $blogcategoryservice,
        SettingService $settingService,

    ) {
        $this->blogService = $blogService;
        $this->blogcategoryservice = $blogcategoryservice;
        $this->settingService = $settingService;

    }

    public function index()
    {
        try {
            $data['pageTitle'] = 'Admin News List';
            $data['pageDescription'] = 'BabVip CMS News List';
            $blogs = $this->blogService->list()->with('category')->paginate(10);
            return view('admin.blog.index', compact('data', 'blogs'));
        } catch (Exception $e) {
            Log::channel('database')->error('News retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function add()
    {
        try {
            $data['pageTitle'] = 'Admin Add News';
            $data['pageDescription'] = 'BabVip CMS Add Categrory';
            $blogCategory = $this->blogcategoryservice->list()->where('status', '1')->get();
            return view('admin.blog.add', compact('data', 'blogCategory'));
        } catch (Exception $e) {
            Log::channel('database')->error('News add  failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function blogStore(Request $request)
    {
        try {
            $this->validateRequest($request, Blogs::validateRules(), Blogs::validateMessages());
            $data = $request->all();
           
            $blog_Slug = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($request->blog_title));
            $data['blog_slug']= $blog_Slug;

        if (!empty($data['blog_image1'])) {
               $blog_image = $this->upload($data['blog_image1']);
               $data['blog_image1']=$blog_image;
           }

        if (!empty($data['blog_image2'])) {
            $blog_image = $this->upload($data['blog_image2']);
            $data['blog_image2']=$blog_image;
        }

        if (!empty($data['blog_image3'])) {
            $blog_image = $this->upload($data['blog_image3']);
            $data['blog_image3']=$blog_image;
        }

            $data['created_by']=Auth::user()->id;

            $this->blogService->create($data);


            return redirect('admin/bloglist')->with('success', 'News created successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('News Add', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function editBlog($id)
    {
        try {
            $data['pageTitle'] = 'Admin Edit News';
            $data['pageDescription'] = 'BabVip CMS Edit News';
            $blogCategory = $this->blogcategoryservice->list()->where('status', '1')->get();
            $blog = $this->blogService->singleDataFindId($id);
            return view('admin.blog.edit', compact('data', 'blogCategory','blog'));
        } catch (Exception $e) {
            Log::channel('database')->error('News edit  failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }


    public function updateBlog(Request $request, $id)
    {
        try {
            $this->validateRequest($request, Blogs::validateRules(), Blogs::validateMessages());
            $data = $request->all();
            
            $blog_Slug = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($request->blog_title));
            $data['blog_slug']= $blog_Slug;

        if (!empty($data['blog_image1'])) {
               $blog_image = $this->upload($data['blog_image1']);
               $data['blog_image1']=$blog_image;
               $this->deleteImage($data['blog_image1_old']);
           }else{
            $data['blog_image1']=$data['blog_image1_old'];
           }

        if (!empty($data['blog_image2'])) {
            $blog_image = $this->upload($data['blog_image2']);
            $data['blog_image2']=$blog_image;
        }else{
            $data['blog_image2']=$data['blog_image2_old'];
           }
        if (!empty($data['blog_image3'])) {
            $blog_image = $this->upload($data['blog_image3']);
            $data['blog_image3']=$blog_image;
        }else{
            $data['blog_image3']=$data['blog_image3_old'];
           }

            $data['created_by']=Auth::user()->id;
            
            $this->blogService->update($data, $id);


            return redirect('admin/bloglist')->with('success', 'News updated successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('News update', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    
    public function updateBlogStatus(Request $request)
    {

        try {
            $id = $request->id;
            $data = array(
                'status' => $request->status,
            );
            $this->blogService->update($data, $id);
            return response()->json(['message' => 'Blog status updated successfully', 'status' => 200]);
        } catch (Exception $e) {
            Log::channel('database')->error('Blog status change failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }



    public function deleteBlog($id)
    {
        try {
            $this->blogService->delete($id);
            return redirect('admin/bloglist')->with('success', 'Blog deleted successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('menu delete', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }


    public function blogSetting(){
        try {
            $data['pageTitle'] = 'Admin Blog Setting';
            $data['pageDescription'] = 'BabVip CMS Admin Admin Blog Setting';
            $blogSetting = $this->settingService->list()->where('setting_type', 'news_setting')->first();
            return view('admin.blog.setting', compact('data', 'blogSetting'));
        } catch (Exception $e) {
            Log::channel('database')->error('Blog Setting Retrived failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function saveBlogSetting(Request $request)
    {
        try {

            $data = $request->all();

            if (!empty($data['news_logo'])) {
                $image = $this->upload($data['news_logo']);
                $data['news_logo'] = $image;
            } else {
                $data['news_logo'] = $data['news_logo_old'];
                unset($data['news_logo_old']);
            }

            if (!empty($data['section1_bg'])) {
                $image = $this->upload($data['section1_bg']);
                $data['section1_bg'] = $image;
            } else {
                $data['section1_bg'] = $data['section1_bg_old'];
                unset($data['section1_bg_old']);
            }

            $storeData = [
                'setting_type' => $data['setting_type'],
                'setting_data' => json_encode($data, true),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            $siteSetting = $this->settingService->list()->where('setting_type', 'news_setting')->count();
            if($siteSetting === 0){
              Settings::insert($storeData);
            }else{
                Settings::where('setting_type', 'news_setting')->update($storeData);
            }
            return redirect('admin/blogsetting')->with('success', 'Setting updated successfully');

        } catch (Exception $e) {
            Log::channel('database')->error('Page Site Setting Retrived failed', [
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
