<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientHistory extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'project_status_id', 'user_id', 'comments'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function projectStatus()
    {
        return $this->belongsTo(ProjectStatus::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
