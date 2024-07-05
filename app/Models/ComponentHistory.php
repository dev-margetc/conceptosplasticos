<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComponentHistory extends Model
{
    use HasFactory;

    protected $fillable = ['component_project_id', 'stock', 'in', 'out'];

    public function componentProject()
    {
        return $this->belongsTo(ComponentProject::class, 'component_project_id');
    }
}
