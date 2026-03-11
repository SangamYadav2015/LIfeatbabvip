<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SectionStyleService;
use App\Services\SectionService;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Traits\ValidatesRequests;
use App\Models\SectionStyle;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class SectionStyleController extends Controller
{
    use ValidatesRequests;

    protected $sectionStyleService;
    protected $sectionService;

    public function __construct(
        SectionStyleService $sectionStyleService,
        SectionService $sectionService
    ) {
        $this->sectionStyleService = $sectionStyleService;
        $this->sectionService = $sectionService;
    }

    public function index()
    {
        try {
            $data['pageTitle'] = 'Admin Section Style List';
            $data['pageDescription'] = 'BabVip CMS Admin Section Style List';
            $sectionstyleData = $this->sectionStyleService->sectionStyleList()->orderBy('section_id', 'ASC')->paginate(10);
            return view('admin.sectionstyle.index', compact('data', 'sectionstyleData'));
        } catch (Exception $e) {
            Log::channel('database')->error('Section Style retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function addSectionStyle()
    {
        try {

            $data['pageTitle'] = 'Admin Create Section Style';
            $data['pageDescription'] = 'BabVip CMS Admin Create Section Style';

            $sectionData = $this->sectionService->sectionList()->get();

            return view('admin.sectionstyle.addSectionStyle', compact('data', 'sectionData'));
        } catch (Exception $e) {
            Log::channel('database')->error('Section Style Add', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }


    public function checkNameExistence(Request $request)
    {
        try {
            $sectionStyleName = $request->section_style_name;
            $sectionId = $request->section_id;
            $exists = $this->sectionStyleService->checkSectionStyleNameExistence($sectionStyleName, $sectionId);
            if ($exists) {
                return response()->json(['exists' => true], 200);
            } else {
                return response()->json(['exists' => false], 200);
            }
        } catch (Exception $e) {
            Log::channel('database')->error('Section Style Add', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function storeSectionStyle(Request $request)
    {
        try {

            $this->validateRequest($request, SectionStyle::validateRules(), SectionStyle::validateMessages());

            $data = $request->all();
          if (!empty($data['preview_image'])) {
                $previewImagImage = $this->upload($data['preview_image']);
            }else{
                $previewImagImage['preview_image']=null;
            }
            $StoreFile = $this->sectionStyleService->createFormFile($data);
            $responseData = json_decode($StoreFile->getContent(), true);
            $storeData = [
                "section_id" => $request->section_id,
                "section_style_name" => $request->section_style_name,
                "file_path" => $responseData['file_name'],
                "file_slug" => $responseData['blade_name'],
                "status" => $request->status,
                "preview_image" => $previewImagImage,
            ];
            $this->sectionStyleService->createSectionStyle($storeData);
            return redirect('admin/sectionstylelist')->with('success', 'Section style created successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('Section Style Add', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function UpdateSectionStyleStatus(Request $request)
    {
        try {
            $id = $request->section_style_id;
            $data = array(
                'status' => $request->status,
            );
            $this->sectionStyleService->update($data, $id);
            return response()->json(['message' => 'Section Style status updated successfully', 'status' => 200]);
        } catch (Exception $e) {
            Log::channel('database')->error('status change failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }



    public function editSectionStyle($id)
    {
        try {
            $data['pageTitle'] = 'Admin Section Style Edit';
            $data['pageDescription'] = 'BabVip CMS Admin Section Style Edit';
            $sectionData = $this->sectionService->sectionList()->get();
            $sectionstyleData = $this->sectionStyleService->singleDataFindId($id);
            return view('admin.sectionstyle.edit', compact('data', 'sectionstyleData', 'sectionData'));
        } catch (Exception $e) {
            Log::channel('database')->error('Section Style edit retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function updateSectionStyle($id, Request $request){
        try {
            $validator=  $this->validateRequest($request, SectionStyle::validateRules(), SectionStyle::validateMessages());

            if ($validator->fails()) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors($validator->errors()->first());
            }

            $data = $request->all();
            $StoreFile = $this->sectionStyleService->createFormFile($data);
            $responseData = json_decode($StoreFile->getContent(), true);

              if (!empty($data['preview_image'])) {
                $previewImage = $this->upload($data['preview_image']);
                $this->deleteImage($data['preview_image_old']);
            }else{
                $previewImage=$data['preview_image_old'];
               }

            $storeData = [
                "section_id" => $request->section_id,
                "section_style_name" => $request->section_style_name,
                "file_path" => $responseData['file_name'],
                "file_slug" => $responseData['blade_name'],
                "status" => $request->status,
                "preview_image" => $previewImage,
            ];
            $this->sectionStyleService->updateSectionStyle($id,$storeData);
            
            return redirect('admin/sectionstylelist')->with('success', 'Section style updated successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('Section Style update', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }


    public function deleteSectionStyle($id){
        try {
            $this->sectionStyleService->deleteSectionStyle($id);
            return redirect('admin/sectionstylelist')->with('success', 'Section style deleted successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('Section Style delete', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

       public function upload(UploadedFile $file)
    {
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('uploads/style-preview', $filename, 'public');
        return $filename;
    }
    public function deleteImage($filename)
    {
        $filePath = 'public/uploads/style-preview/' . $filename;
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
    }
}
