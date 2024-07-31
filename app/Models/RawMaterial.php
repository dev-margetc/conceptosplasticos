<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'reference',
        'cost_kg',
        'stock',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function component()
    {
        return $this->belongsToMany(Component::class, 'component_raw_material')
                    ->withPivot('percentage')
                    ->withTimestamps();
    }
}
