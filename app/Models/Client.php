<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'business_type_id',
        'customer_type_id',
        'name',
        'phone',
        'email',
        'address',
        'lead_origin',
    ];

    public function clientHistory()
    {
        return $this->hasMany(ClientHistory::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    // public function projectStatus()
    // {
    //     return $this->belongsTo(ProjectStatus::class);
    // }
    public function getLatestProjectStatusAttribute()
    {
        return $this->clientHistory()->latest()->first()->projectStatus ?? null;
    }

    public function rawMaterial()
    {
        return $this->hasMany(RawMaterial::class);
    }

    public function businessType()
    {
        return $this->belongsTo(BusinessType::class);
    }

    public function customerType()
    {
        return $this->belongsTo(CustomerType::class);
    }

    public function component()
    {
        return $this->hasMany(Component::class);
    }
    public function project()
    {
        return $this->hasMany(Project::class);
    }
}
