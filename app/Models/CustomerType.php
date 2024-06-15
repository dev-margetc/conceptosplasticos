<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerType extends Model
{
    use HasFactory;

    protected $fillable = ['business_type_id', 'name'];

    public function businessType()
    {
        return $this->belongsTo(BusinessType::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }
}
