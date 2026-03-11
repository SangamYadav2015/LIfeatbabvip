<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\FaqService;
use App\Models\Faq;

class FaqController extends Controller
{
    protected $faqService;

    public function __construct(FaqService $faqService)
    {
        $this->faqService = $faqService;
    }

    public function index()
    {
        $faqs = $this->faqService->getAllFaqs()->paginate(10);
        return view('admin.faq.index', compact('faqs'));
    }
    
    public function add()
    {
        return view('admin.faq.add');
    }

    public function store(Request $request)
    {
        $data = $request->all();
    
        $request->validate(
            Faq::validateRules(),
            Faq::validateMessages()
        );
    
        $this->faqService->storeFaq($request->only('question'));
    
        return redirect()->back()->with('success', 'FAQ added successfully!');
    }
    
     public function updateFaqStatus(Request $request)
    {

        try {
            $id = $request->id;
            $data = array(
                'status' => $request->status,
            );
            $this->faqService->update($data, $id);
            return response()->json(['message' => 'Faq status updated successfully', 'status' => 200]);
        } catch (Exception $e) {
            Log::channel('database')->error('Faq status change failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }
    public function edit($id)
    {
        $faq = $this->faqService->findFaq($id); // or Faq::findOrFail($id);
        return view('admin.faq.edit', compact('faq'));
    }
    
   public function update(Request $request, $id)
{
    $request->validate(Faq::validateRules(), Faq::validateMessages());

    $this->faqService->updateFaq([
        'question' => $request->question,
        'status'   => $request->status === 'active' ? 1 : 0,
    ], $id);

    return redirect()->route('admin.faq.index')->with('success', 'FAQ updated successfully!');
}
    
    public function deleteFaq($id)
    {
        $this->faqService->deleteFaq($id);
        return redirect()->back()->with('success', 'FAQ deleted successfully!');
    }

}
