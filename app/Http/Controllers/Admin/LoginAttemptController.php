<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Services\UserLoginAttemptServices;

class LoginAttemptController extends Controller
{
    protected $userLoginAttemptServices;

    public function __construct(
        UserLoginAttemptServices $userLoginAttemptServices,

    ) {
        $this->userLoginAttemptServices = $userLoginAttemptServices;

    }

    public function index()
    {
        try {
            $data['pageTitle'] = 'Admin News List';
            $data['pageDescription'] = 'BabVip CMS News List';
            $attemptData = $this->userLoginAttemptServices->list()->with('user')->where('status','!=', 1)->paginate(10);
            return view('admin.login-attempt.index', compact('data', 'attemptData'));
        } catch (Exception $e) {
            Log::channel('database')->error('News retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }
}
