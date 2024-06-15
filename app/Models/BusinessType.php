<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessType extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function customerTypes()
    {
        return $this->hasMany(CustomerType::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }
}
