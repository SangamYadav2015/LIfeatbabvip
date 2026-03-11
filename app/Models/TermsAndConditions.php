<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class TermsAndConditions extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'status',
    ];

    /**
     * Validation rules for storing/updating a term.
     *
     * @param null|int $id
     * @return array
     */
    public static function validateRules($id = null)
    {
        return [
            'title' => 'required|string|max:255|unique:terms_and_conditions,title' . ($id ? ",$id" : ''),
            'content' => 'required|string',
            'status' => 'required|in:active,inactive',
        ];
    }

    /**
     * Validation messages for the rules.
     *
     * @return array
     */
    public static function validateMessages()
    {
        return [
            'title.required' => 'The title field is required.',
            'title.string' => 'The title must be a string.',
            'title.max' => 'The title may not be greater than 255 characters.',
            'title.unique' => 'The title has already been taken.',
            'content.required' => 'The content field is required.',
            'content.string' => 'The content must be a string.',
            'status.required' => 'The status field is required.',
            'status.in' => 'The selected status is invalid.',
        ];
    }

    /**
     * Validate the data against the rules.
     *
     * @param array $data
     * @param null|int $id
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function validate(array $data, $id = null)
    {
        return Validator::make($data, self::validateRules($id), self::validateMessages());
    }
}
