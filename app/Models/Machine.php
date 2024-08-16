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
    public function calculateTotalHours($totalProjectWeight)
    {
        $totalCapacity = $this->where('status', '1')->sum('capacity');
        return $totalCapacity > 0 
            ? $totalProjectWeight / $totalCapacity 
            : 0;
    }
}
