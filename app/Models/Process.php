<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function machine()
    {
        return $this->belongsToMany(Machine::class, 'machine_process');
    }
}
