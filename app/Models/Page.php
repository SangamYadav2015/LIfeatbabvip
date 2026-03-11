<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id',
        'page_data',
        'status',
        'is_home',
        'created_by',
    ];

    public static function validateRules()
    {
        return [
            'menu_id' => 'required|exists:menus,id',
            'page_data' => 'nullable|array',
            'status' => 'required|in:active,inactive',
        ];
    }

    public static function validateMessages()
    {
        return [
            'menu_id.required' => 'Please select menu.',
            'menu_id.exists' => 'The selected menu already used.',
            'status.required' => 'The status is required.',
            'status.in' => 'The status must be either active or inactive.',
        ];
    }


    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function pageSections()
{
    return $this->hasMany(PageSection::class, 'page_id');
}

}
