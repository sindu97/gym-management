<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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


    public function specialPrice(): HasMany
    {
        return $this->hasMany(SpecialPlanPrice::class, 'special_package_id');
    }
}
