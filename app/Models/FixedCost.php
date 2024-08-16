<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FixedCost extends Model
{
    use HasFactory;

    protected $fillable = [
        'item',
        'unit_value',
        'stake',
        'project_id'
    ];
}
