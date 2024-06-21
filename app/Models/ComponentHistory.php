<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComponentHistory extends Model
{
    use HasFactory;

    protected $fillable = ['component_id', 'stock', 'in', 'out'];

    public function component()
    {
        return $this->belongsTo(Component::class);
    }
}
