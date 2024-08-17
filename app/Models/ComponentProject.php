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
        'is_selected',
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

    public static function getComponentMaterials($projectId)
    {
        return self::query()
            ->join('components', 'component_project.component_id', '=', 'components.id')
            ->join('component_raw_material', 'components.id', '=', 'component_raw_material.component_id')
            ->join('raw_materials', 'component_raw_material.raw_material_id', '=', 'raw_materials.id')
            ->where('component_project.project_id', $projectId)
            ->where('component_project.is_selected', 1)
            ->select(
                'component_project.id', 
                'components.name as component_name', 
                'raw_materials.name as material_name',
                'raw_materials.cost_kg as cost_kg',
                'component_raw_material.percentage'
            );
    }
}
