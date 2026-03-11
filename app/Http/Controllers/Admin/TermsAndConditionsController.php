<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Services\TermsAndConditionsService;
use App\Models\TermsAndConditions;


class TermsAndConditionsController extends Controller
{
    protected $termsAndConditionsService;

    public function __construct(TermsAndConditionsService $termsAndConditionsService)
    {
        $this->termsAndConditionsService = $termsAndConditionsService;
    }

    public function index()
    {
        try {
            $data['pageTitle'] = 'Terms and Conditions List';
            $data['pageDescription'] = 'List of all terms and conditions';
            $termsData = TermsAndConditions::paginate(10); // Change 10 to your desired items per page
            return view('admin.terms.index', compact('data', 'termsData'));
        } catch (Exception $e) {
            Log::error('Terms and Conditions retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function create()
    {
        try {
            $data['pageTitle'] = 'Add Terms and Conditions';
            return view('admin.terms.create', compact('data'));
        } catch (Exception $e) {
            Log::error('Failed to load create terms view', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

   public function store(Request $request)
{
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
    ]);

    try {
        $this->termsAndConditionsService->createTerm($data);
        return redirect()->route('admin.terms.index')->with('success', 'Terms and conditions added successfully');
    } catch (Exception $e) {
        Log::error('Failed to create terms and conditions', [
            'error' => $e->getMessage(),
            'stack_trace' => $e->getTraceAsString(),
        ]);
        return redirect()->back()->with('error', 'Something went wrong. Please try again.');
    }
}


    public function edit($id)
    {
        try {
            $data['pageTitle'] = 'Edit Terms and Conditions';
            $term = $this->termsAndConditionsService->getTermById($id);
            return view('admin.terms.edit', compact('data', 'term'));
        } catch (Exception $e) {
            Log::error('Failed to load edit terms view', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
               
            ]);

            $this->termsAndConditionsService->updateTerm($data, $id);
            return redirect()->route('admin.terms.index')->with('success', 'Terms and conditions updated successfully');
        } catch (Exception $e) {
            Log::error('Failed to update terms and conditions', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function delete($id)
    {
        try {
            $this->termsAndConditionsService->deleteTerm($id);
            return redirect()->route('admin.terms.index')->with('success', 'Terms and conditions deleted successfully');
        } catch (Exception $e) {
            Log::error('Failed to delete terms and conditions', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

   
    
}
