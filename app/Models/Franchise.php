<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Franchise extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'brand_logo',
        'country',
        'currency',
        'identification',
        'address',
        'zip_code',
        'contact_phone',
        'email',
        'website_url',
    ];

    public function getImageUrlAttribute()
    {
        return $this->image_path ? Storage::url($this->image_path) : null;
    }
}
