<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_name',
        'salary',
        'transport_assistance',
        'overtime_surcharge',
        'epp',
        'health',
        'pension',
        'severance_pay',
    ];

    public function project()
    {
        return $this->belongsToMany(Project::class)->withPivot('number_shifts')->withTimestamps();
    }
}
