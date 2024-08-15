<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialPlanPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'special_package_id',
        'plan_type_id',
        'slug',
        'price'
    ];
}
