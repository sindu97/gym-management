<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;


    protected $fillable = [
        "user_id",
        "country_code",
        "address",
        "phone",
        "state",
        "city",
        "country",
        "zip"
    ];
}
