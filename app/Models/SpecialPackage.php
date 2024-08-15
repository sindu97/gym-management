<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialPackage extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'slug',
        'start_date',
        'end_date',
        'price',
        'template_id',
        'status',
    ];
}
