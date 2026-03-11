<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use App\Services\SubscriberService;
use stdClass;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Traits\ValidatesRequests;
use App\Mail\SubscriberMail;
use Illuminate\Support\Facades\Mail;

class SubscriberController extends Controller
{
    use ValidatesRequests;

    protected $subscriberService;

    public function __construct(
        SubscriberService $subscriberService,
    ) {
        $this->subscriberService = $subscriberService;
    }

    public function saveNewsletter(Request $request)
    {
        try {
            $this->validateRequest($request, Subscriber::validateRules(), Subscriber::validateMessages());
            $ipAddress = $request->ip();
            $data = [
                'email' => $request->input('email'),
                'ip_address' => $ipAddress,
            ];
            $this->subscriberService->create($data);
            Mail::to($request->input('email'))->send(new SubscriberMail(
                $request->input('email'),
            ));
            return response()->json(['message' => 'Thank You For Subscription', 'status' => 200]);
        } catch (Exception $e) {
            Log::channel('database')->error('News Letter', [
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
