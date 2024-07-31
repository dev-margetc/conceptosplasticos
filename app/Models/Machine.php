<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'capacity',
        'status',
    ];

    public function process()
    {
        return $this->belongsToMany(Process::class, 'machine_process');
    }
}
