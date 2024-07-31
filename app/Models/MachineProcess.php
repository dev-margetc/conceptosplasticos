<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachineProcess extends Model
{
    use HasFactory;

    protected $table = 'machine_process';
    protected $fillable = ['machine_id', 'process_id'];

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }

    public function process()
    {
        return $this->belongsTo(Process::class);
    }
}
