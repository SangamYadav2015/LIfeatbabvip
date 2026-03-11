<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ContactEnqueryService;
use Illuminate\Support\Facades\Log;
use Exception;
class ContactEnqueryController extends Controller
{
    protected $ContactEnqueryService;
    public function __construct(
        ContactEnqueryService $ContactEnqueryService,
    ) {
        $this->ContactEnqueryService = $ContactEnqueryService;
    }
  
    public function index()
    {
        try {
            $data['pageTitle'] = 'Admin Contact Enqueries List';
            $data['pageDescription'] = 'BabVip CMS Contact Enqueries List';
            $contactEnqueries = $this->ContactEnqueryService->list()->orderBy('created_at','DESC')->paginate(10);
            return view('admin.contact-enquery.index', compact('data', 'contactEnqueries'));
        } catch (Exception $e) {
            Log::channel('database')->error('News retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

public function destroy($id)
{
    try {
        $this->ContactEnqueryService->delete($id);

        return redirect()->route('admin.enqueryList')
                         ->with('success', 'Contact enquiry deleted successfully.');
    } catch (Exception $e) {
        Log::channel('database')->error('Contact enquiry deletion failed', [
            'id' => $id,
            'error' => $e->getMessage(),
            'stack_trace' => $e->getTraceAsString(),
        ]);
        return redirect()->route('admin.enqueryList')
                         ->with('error', 'Failed to delete contact enquiry.');
    }
}

public function enqueryListExport()
    {
        try {
            $fileName = 'contact-enquiry-export.csv';
            $contacts =  $this->ContactEnqueryService->list()->get();

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
                fputcsv($file, ['Name', 'Email', 'Subject', 'Phone', 'Message', 'Date & Time']);

                // Data rows
                foreach ($contacts as $item) {
                    fputcsv($file, [
                        $item->first_name . ' ' .   $item->last_name,
                        $item->email,
                        $item->subject,
                        $item->phone,
                        $item->message,
                        date("d M Y g:i:a", strtotime($item->created_at))
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
