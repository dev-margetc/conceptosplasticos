<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FixedCost extends Model
{
    use HasFactory;

    protected $fillable = [
        'item',
        'unit_value',
        'stake',
        'project_id',
        'is_fixed'
    ];

    public static function calculateFixedCosts($projectId)
    {
        return self::where('project_id', $projectId)
            ->where('is_fixed', 0)
            ->get()
            ->reduce(function ($carry, $item) {
                return $carry + ($item->unit_value * ($item->stake / 100));
            }, 0);
    }

    public static function calculateVariableCosts($projectId)
    {
        return self::where('project_id', $projectId)
            ->where('is_fixed', 1)
            ->get()
            ->reduce(function ($carry, $item) {
                return $carry + ($item->unit_value * ($item->stake / 100));
            }, 0);
    }

    public static function calculateTotalCosts($projectId)
    {
        return self::calculateFixedCosts($projectId) + self::calculateVariableCosts($projectId);
    }
}
