<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Traits\ValidatesRequests;
use App\Models\HelpFaq;
use App\Services\HelpFaqService;
use App\Services\HelpCategoryService;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class HelpFaqController extends Controller
{
    use ValidatesRequests;

    protected $helpFaqService;
    protected $helpCategoryService;
    public function __construct(
        HelpFaqService $helpFaqService,
        HelpCategoryService $helpCategoryService,

    ) {
        $this->helpFaqService = $helpFaqService;
        $this->helpCategoryService = $helpCategoryService;
     }

     public function index()
     {
         try {
             $data['pageTitle'] = 'Admin Help Faq List';
             $data['pageDescription'] = 'BabVip CMS Admin Help Faq List';
             $helpFaq = $this->helpFaqService->list()->with('helpCategory')->paginate(10);
             return view('admin.help-faq.index', compact('data', 'helpFaq'));
         } catch (Exception $e) {
             Log::channel('database')->error('Admin Help Faq retrieval failed', [
                 'error' => $e->getMessage(),
                 'stack_trace' => $e->getTraceAsString(),
             ]);
             return response()->view('errors.500', [], 500);
         }
     }

     public function updateHelpFaqstatus(Request $request)
     {
         try {
             $id = $request->id;
             $data = array(
                 'status' => $request->status,
             );
             $this->helpFaqService->update($data, $id);
             return response()->json(['message' => 'Help Faq status updated successfully', 'status' => 200]);
         } catch (Exception $e) {
             Log::channel('database')->error('Help Faq change failed', [
                 'error' => $e->getMessage(),
                 'stack_trace' => $e->getTraceAsString(),
             ]);
             return response()->view('errors.500', [], 500);
         }
     }
 

     public function add()
    {
        try {
            $data['pageTitle'] = 'Admin Add Help Faq Questions';
            $data['pageDescription'] = 'BabVip CMS Add Help Faq Questions';
            $helpCategory = $this->helpCategoryService->list()->where('status', '1')->orderBy('category_name','ASC')->get();
            return view('admin.help-faq.add', compact('data', 'helpCategory'));
        } catch (Exception $e) {
            Log::channel('database')->error('Help Faq Questions add  failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function helpFaqStore(Request $request)
    {
        try {
            $this->validateRequest($request, HelpFaq::validateRules(), HelpFaq::validateMessages());
            $data = $request->all();
           
            $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $request->question);
            $data['slug']= $slug;
            $this->helpFaqService->create($data);
            return redirect('admin/helpfaqlist')->with('success', 'Question created successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('Help Faq Add', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function editFaqHelp($id)
    {
        try {
            $data['pageTitle'] = 'Admin Edit Help faq';
            $data['pageDescription'] = 'BabVip CMS Edit Help faq';
            $helpCategory = $this->helpCategoryService->list()->where('status', '1')->orderBy('category_name','ASC')->get();
            $helpFaq = $this->helpFaqService->singleDataFindId($id);
            return view('admin.help-faq.edit', compact('data', 'helpCategory', 'helpFaq'));
        } catch (Exception $e) {
            Log::channel('database')->error('Help faq edit failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function updateFaqHelplog(Request $request, $id)
    {
        try {
            $this->validateRequest($request, HelpFaq::validateRules(), HelpFaq::validateMessages());
            $data = $request->all();
            $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $request->question);
            $data['slug']= $slug;            
            $this->helpFaqService->update($data, $id);
            return redirect('admin/helpfaqlist')->with('success', 'Help faq updated successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('Help faq update', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }


    public function deleteFaqHelp($id)
    {
        try {
            $this->helpFaqService->delete($id);
            return redirect('admin/helpfaqlist')->with('success', 'Help faq deleted successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('Help faq delete', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }


}
