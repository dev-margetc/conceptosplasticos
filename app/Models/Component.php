<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'group_id', 'quantity', 'weight', 'total_weight', 'wall', 'ubication', 'large' ];

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
    public function getKgPriceAttribute()
    {
        return $this->rawMaterial->sum('cost_kg');
    }
    public function getLatestStockAttribute()
    {
        return $this->componentHistory()->orderBy('created_at', 'desc')->first()->stock ?? 0;
    }
    public function getTotalCostAttribute()
    {
        return $this->quantity * $this->rawMaterial->sum('cost_kg');
    }
}
