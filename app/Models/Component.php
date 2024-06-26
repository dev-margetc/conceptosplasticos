<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'stock', 'client_id', 'group_id'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function componentHistory()
    {
        return $this->hasMany(ComponentHistory::class);
    }
    public function rawMaterial()
    {
        return $this->belongsToMany(RawMaterial::class, 'component_raw_material')
                    ->withPivot('percentage')
                    ->withTimestamps();
    }
}
