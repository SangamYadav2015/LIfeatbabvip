<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\LogsServices;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Traits\ValidatesRequests;
use Illuminate\Support\Facades\Auth;

class LogsController extends Controller
{
    use ValidatesRequests;
    protected $logsService;

    public function __construct(
        LogsServices $logsService,
        ) {
        $this->logsService = $logsService;
    }

    public function index()
    {
        try {
            $data['pageTitle'] = 'Admin Section Logs List';
            $data['pageDescription'] = 'BabVip CMS Admin Section Logs List';
            $logs = $this->logsService->list()->where('status', '!=', 'Resolved')->orderBy('Created_at', 'DESC')->paginate(10);
            return view('admin.logs.index', compact('data', 'logs'));
        } catch (Exception $e) {
            Log::channel('database')->error('Logs retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    
   

    public function viewLogs($id)
    {
        try {
            $data['pageTitle'] = 'Admin Page  Logs View';
            $data['pageDescription'] = 'BabVip CMS Admin Logs View';
            $log = $this->logsService->singleDataFindId($id);
            return view('admin.logs.view', compact('data', 'log'));
        } catch (Exception $e) {
            Log::channel('database')->error('Log view retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function updateLogStatus(Request $request)
    {

        try {
            $id = $request->id;
            $data = array(
                'status' => $request->status,
            );
            $this->logsService->update($data, $id);
            return response()->json(['message' => 'Logs Status updated successfully', 'status' => 200]);
        } catch (Exception $e) {
            Log::channel('database')->error('Logs Status change failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }
   
    // public function deletePage($id)
    // {
    //     try {
    //         $this->logsService->delete($id);
    //         return redirect('admin/pagelist')->with('success', 'Page deleted successfully');
    //     } catch (Exception $e) {
    //         Log::channel('database')->error('page delete', [
    //             'error' => $e->getMessage(),
    //             'stack_trace' => $e->getTraceAsString(),
    //         ]);
    //         return response()->view('errors.500', [], 500);
    //     }
    // }
}
