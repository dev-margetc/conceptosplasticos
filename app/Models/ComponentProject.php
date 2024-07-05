<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComponentProject extends Model
{
    use HasFactory;

    protected $table = 'component_project';

    protected $fillable = [
        'component_id',
        'project_id',
    ];

    public function component()
    {
        return $this->belongsTo(Component::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function history()
    {
        return $this->hasMany(ComponentHistory::class, 'component_project_id');
    }
}
