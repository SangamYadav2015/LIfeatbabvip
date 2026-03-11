<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SectionService;
use Illuminate\Support\Facades\Log;
use Exception;

class SectionController extends Controller
{
    protected $sectionService;

    public function __construct(SectionService $sectionService)
    {
        $this->sectionService = $sectionService;
    }

    public function index()
    {
        try {
            $data['pageTitle'] = 'Admin Section List';
            $data['pageDescription'] = 'BabVip CMS Admin Section List';
            $sectionData = $this->sectionService->sectionList()->paginate(10);
            return view('admin.section.index', compact('data', 'sectionData'));
        } catch (Exception $e) {
            Log::channel('database')->error('User retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function UpdateSectionStatus(Request $request)
    {
        try {
            $id = $request->section_id;
            $data = array(
                'status' => $request->status,
            );
            $this->sectionService->update($data, $id); 
            return response()->json(['message' => 'Section status updated successfully', 'status' => 200]);
        } catch (Exception $e) {
            Log::channel('database')->error('User retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }
}
