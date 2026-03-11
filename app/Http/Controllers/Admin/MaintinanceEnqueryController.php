<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\MaintinanceEnqueryService;
use App\Models\MaintinanceEnquery;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Traits\ValidatesRequests;
use App\Mail\ContactUsMail;
use Illuminate\Support\Facades\Mail;
class maintinanceEnqueryController extends Controller
{
    use ValidatesRequests;

    protected $maintinanceEnqueryService;
    public function __construct(
        MaintinanceEnqueryService $maintinanceEnqueryService,
    ) {
        $this->maintinanceEnqueryService = $maintinanceEnqueryService;
    }
  
    public function index()
    {
        try {
            $data['pageTitle'] = 'Admin Contact Enqueries List';
            $data['pageDescription'] = 'BabVip CMS Contact Enqueries List';
            $contactEnqueries = $this->maintinanceEnqueryService->list()->orderBy('created_at','DESC')->paginate(10);
            return view('admin.maintinance-enquery.index', compact('data', 'contactEnqueries'));
        } catch (Exception $e) {
            Log::channel('database')->error('News retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }


    public function saveMaintinanceEnquery(Request $request)
    {
        try {

            $this->validateRequest($request, MaintinanceEnquery::validateRules(), MaintinanceEnquery::validateMessages());
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
            $this->maintinanceEnqueryService->create($data);
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
     public function maintinanceEnqueryExport()
    {
        try {
            $fileName = 'maintinance-enquiry-export.csv';
            $contacts =  $this->maintinanceEnqueryService->list()->get();

            $headers = [
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            ];

            $callback = function () use ($contacts) {
                $file = fopen('php://output', 'w');

                // Header row
                fputcsv($file, ['Name', 'Email', 'Subject', 'Phone', 'Message']);

                // Data rows
                foreach ($contacts as $item) {
                    fputcsv($file, [
                        $item->first_name . ' ' .   $item->last_name,
                        $item->email,
                        $item->subject,
                        $item->phone,
                        $item->message
                    ]);
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        } catch (Exception $e) {
            Log::channel('database')->error('News retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

}
