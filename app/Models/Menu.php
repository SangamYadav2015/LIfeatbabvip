<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'parent_id',
        'show_header',
        'show_footer',
        'status',
        'sort_id',
        'menu_slug',
        'is_horizontal',
        'menu_image',
        'menu_description',
        'is_horizontal'
    ];

    public static function validateRules($id = null)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'parent_id' => 'nullable|integer|exists:menus,id',
            'show_header' => 'boolean',
            'show_footer' => 'boolean',
            'status' => 'required|boolean',
            'sort_id' => 'nullable|integer',
        ];

        if ($id !== null) {
            // Exclude current ID from unique check for title if updating
            $rules['title'] .= ',' . $id;
        } else {
            // Ensure title is unique when creating new record
            $rules['title'] .= '|unique:menus,title';
        }

        return $rules;
    }



    public static function validateMessages()
    {
        return [
            'title.required' => 'The title field is required.',
            'title.string' => 'The title must be a string.',
            'title.max' => 'The title may not be greater than :max characters.',
            'title.unique' => 'The title has already been taken.',
            'parent_id.integer' => 'The parent ID must be an integer.',
            'parent_id.exists' => 'The selected parent ID is invalid.',
            'show_header.boolean' => 'The show header field must be true or false.',
            'show_footer.boolean' => 'The show footer field must be true or false.',
            'status.required' => 'The status field is required.',
            'status.boolean' => 'The status field must be true or false.',
            'sort_id.integer' => 'The sort ID must be an integer.',
        ];
    }


    public function parentMenu()
    {
        return $this->belongsTo(Menu::class, "parent_id");
    }

    public function childrenMenu()
    {
        return $this->hasMany(Menu::class, "parent_id");
    }

    public function childrenRecursive()
    {
        return $this->hasMany(Menu::class, 'parent_id')->with('childrenRecursive')->orderBy('sort_id', 'ASC');
    }

    public function pages()
    {
        return $this->belongsTo(page::class, "id", "menu_id");
    }
}
