<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\ContactEnquery;
use App\Services\MenuService;
use App\Services\PageService;
use App\Services\PageSectionService;
use App\Services\SettingService;
use App\Services\ContactEnqueryService;
use stdClass;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Traits\ValidatesRequests;
use App\Mail\ContactUsMail;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    use ValidatesRequests;

    protected $menuService;
    protected $pageService;
    protected $pageSectionService;
    protected $settingService;
    protected $contactEnqueryService;

    public function __construct(
        MenuService $menuService,
        PageService $pageService,
        PageSectionService $pageSectionService,
        SettingService $settingService,
        contactEnqueryService $contactEnqueryService,


    ) {
        $this->menuService = $menuService;
        $this->pageService = $pageService;
        $this->pageSectionService = $pageSectionService;
        $this->settingService = $settingService;
        $this->contactEnqueryService = $contactEnqueryService;
    }

    public function index()
    {
        try {
            $siteSetting = $this->settingService->list()->where('setting_type', 'site_setting')->first();
            $footerSetting = $this->settingService->list()->where('setting_type', 'footer_setting')->first();
            $headData = ['meta_title' => "Contact Us", "meta_description" => "Contact Us"];
            $jsonString = json_encode($headData);
            $pageData = new stdClass();
            $pageData->page_data = $jsonString;

            return view('site.contact-us', ['pageData' => $pageData], compact('siteSetting', 'footerSetting'));
        } catch (Exception $e) {
            Log::channel('database')->error('Page File Content Get', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function saveContact(Request $request)
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

            return response()->json(['message' => 'Enquery successfully send our team get in touch with you soon', 'status' => 200]);
        } catch (Exception $e) {
            Log::channel('database')->error('Section Style Add', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function destroy($id)
{
    try {
        $this->contactEnqueryService->delete($id); // Assuming you have a delete method
        return redirect()->back()->with('success', 'Contact enquiry deleted successfully.');
    } catch (Exception $e) {
        Log::channel('database')->error('Contact enquiry delete failed', [
            'error' => $e->getMessage(),
            'stack_trace' => $e->getTraceAsString(),
        ]);
        return redirect()->back()->with('error', 'Failed to delete contact enquiry.');
    }
}

}
