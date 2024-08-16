<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'name',
        'status',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function component()
    {
        return $this->belongsToMany(Component::class, 'component_project');
    }
    public function staff()
    {
        return $this->belongsToMany(Staff::class)->withPivot('id','number_shifts')->withTimestamps();
    }
    public function getTotalWeightAttribute()
    {
        return $this->component()->sum(DB::raw('weight * quantity'));
    }
}
