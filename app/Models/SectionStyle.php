<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionStyle extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_id',
        'section_style_name',
        'file_path',
        'file_slug',
        'status',
        'preview_image',
    ];

    public static function validateRules()
    {
        return [
            'section_id' => 'required|integer',
            'section_style_name' => 'required|string',
            'status' => 'required|in:0,1',
            'fileData' => 'required',
        ];
    }
    public static function validateMessages()
    {
        return [
            'section_id.required' => 'The section id is required.',
            'section_id.integer' => 'The section id must be an integer.',
            'section_style_name.required' => 'The section style name is required.',
            'section_style_name.string' => 'The section style name must be a string.',
            'status.required' => 'The status is required.',
            'status.in' => 'The status must be either 0 or 1.',
            'fileData.required' => 'The Html Form Data is required.',
        ];
    }
    public function section(){
        return $this->belongsTo(Section::class);
    }
}
