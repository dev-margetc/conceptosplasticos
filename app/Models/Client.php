<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'business_type',
        'customer_type',
        'name',
        'phone',
        'email',
        'address',
        'lead_origin',
        'project_name',
        'project_status_id',
        'comment'
    ];

    public function projectStatus()
    {
        return $this->belongsTo(ProjectStatus::class, 'project_status_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
