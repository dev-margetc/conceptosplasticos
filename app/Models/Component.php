<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Component extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'group_id',
        'quantity',
        'weight',
        'total_weight',
        'wall',
        'ubication',
        'large',
        'length',
        'broad',
        'height',
        'value_kilo',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function componentHistory()
    {
        return $this->hasManyThrough(ComponentHistory::class, ComponentProject::class, 'component_id', 'component_project_id');
    }
    public function rawMaterial()
    {
        return $this->belongsToMany(RawMaterial::class, 'component_raw_material')
                    ->withPivot('percentage')
                    ->withTimestamps();
    }
    public function project()
    {
        return $this->belongsToMany(Project::class, 'component_project');
    }
    // public function getKgPriceAttribute()
    // {
    //     return $this->rawMaterial->sum('cost_kg');
    // }
    public function getStockAttribute()
    {
        return $this->componentHistory()
        ->whereHas('componentProject', function ($query) {
            $query->whereNull('project_id');
        })
        ->sum('stock');
    }
    public function componentProject()
    {
        return $this->hasMany(ComponentProject::class);
    }
    public static function isComponentSelectable($componentName, $projectId)
    {
        $exists = self::query()
            ->where('name', $componentName)
            ->whereHas('componentProject', function ($query) use ($projectId) {
                $query->where('project_id', $projectId)
                      ->where('is_selected', 1);
            })
            ->exists();

        return $exists; 
    }

    public static function getSelectedComponent($componentName, $projectId): ?Component
    {
        return self::query()
            ->join('component_project', 'components.id', '=', 'component_project.component_id')
            ->where('components.name', $componentName)
            ->where('component_project.project_id', $projectId)
            ->where('component_project.is_selected', 1)
            ->select('components.*')
            ->first();
    }

    public function getMaterialsQuery(): Builder
    {
        return $this->rawMaterial()
            ->select(
                'raw_materials.name as material_name', 
                'component_raw_material.percentage',
                'component_raw_material.raw_material_id as id'
            )
            ->getQuery();

    }
}
