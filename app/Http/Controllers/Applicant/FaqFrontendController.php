<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\FaqService;
use App\Services\FaqResponseService;

class FaqFrontendController extends Controller
{
    protected $faqService, $responseService;

    public function __construct(FaqService $faqService, FaqResponseService $responseService)
    {
        $this->faqService = $faqService;
        $this->responseService = $responseService;
    }

    public function index()
    {
        $faqs = $this->faqService->getAllFaqs();
        return view('frontend.faq', compact('faqs'));
    }

    public function storeResponse(Request $request)
    {
        $request->validate([
            'faq_id' => 'required|exists:faqs,id',
            'response' => 'required|in:yes,no',
        ]);

        $this->responseService->storeResponse($request->only('faq_id', 'response'));

        return response()->json(['message' => 'Response recorded']);
    }

}
