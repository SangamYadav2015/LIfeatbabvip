<?php

namespace App\Repositories;

use App\Models\SectionStyle;
use App\Models\Section;
use Illuminate\Support\Facades\File;

class SectionStyleRepository
{
    protected $model;

    public function __construct(SectionStyle $sectionStyle)
    {
        $this->model = $sectionStyle;
    }
    public function list()
    {
        return $this->model;
    }
    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function update(array $attributes, $id)
    {
        $record = $this->model->findOrFail($id);
        $record->update($attributes);
        return $record;
    }
    public function sectionStyleNameCheck($sectionStyleName, $sectionId)
    {
        return SectionStyle::where('section_style_name', $sectionStyleName)
            ->where('section_id', $sectionId)
            ->exists();
    }

    public function storeCreateFileblade($data)
    {
        $sectionId = $data['section_id'];
        $htmlContent = $data['fileData'];
        $sectionStyleName = $data['section_style_name'];

        $section = Section::where('id', $sectionId)->first();
        $sectionName = $section->section_name;

        $cleanSectionName = preg_replace('/[^A-Za-z0-9]/', '', $sectionName);
        $cleanSectionStyleName = preg_replace('/[^A-Za-z0-9]/', '', $sectionStyleName);
        $mergedName = $cleanSectionName . $cleanSectionStyleName;
        $fileName = $mergedName . '.blade.php';

        $filePath = resource_path('views/admin/style-form-template/' . $fileName);
        if (!File::isDirectory(dirname($filePath))) {
            File::makeDirectory(dirname($filePath), 0755, true, true);
        }
        File::put($filePath, $htmlContent);
        $responseData = [
            'file_name' => $fileName,
            'blade_name' => $mergedName,
        ];

        return response()->json($responseData);
    }

    public function delete($id)
    {
        $sectionStyle = SectionStyle::findOrFail($id);
        $fileName = $sectionStyle->file_path;
        $filePath = resource_path('views/admin/style-form-template/' . $fileName);
        if (file_exists($filePath)) {
            unlink($filePath); // Delete the file if it exists
        }
        $sectionStyle->delete();
        return $sectionStyle;
    }
}
