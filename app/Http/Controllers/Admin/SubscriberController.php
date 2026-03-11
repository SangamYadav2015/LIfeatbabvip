<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SubscriberService;
use Illuminate\Support\Facades\Log;
use Exception;
class SubscriberController extends Controller
{
    protected $subscriberService;
    public function __construct(
        SubscriberService $subscriberService,
    ) {
        $this->subscriberService = $subscriberService;
    }
  
    public function index()
    {
        try {
            $data['pageTitle'] = 'Admin Subscriber List';
            $data['pageDescription'] = 'BabVip CMS Subscriber List';
            $subscribers = $this->subscriberService->list()->orderBy('created_at','DESC')->paginate(10);
            return view('admin.subscriber.index', compact('data', 'subscribers'));
        } catch (Exception $e) {
            Log::channel('database')->error('News subscribers failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function toggleStatus($id)
{
    try {
        $subscriber = $this->subscriberService->toggleStatus($id);
        $status = $subscriber->status ? 'activated' : 'deactivated';

        return redirect()->back()->with('success', "Subscriber has been {$status}.");
    } catch (\Exception $e) {
        Log::channel('database')->error('Toggle subscriber status failed', [
            'id' => $id,
            'error' => $e->getMessage(),
        ]);
        return response()->view('errors.500', [], 500);
    }
}

}
