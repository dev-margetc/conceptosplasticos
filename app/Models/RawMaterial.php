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
        'length',
        'broad',
        'height',
        'stock',
        'client_id',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
