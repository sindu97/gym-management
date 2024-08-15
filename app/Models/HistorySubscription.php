<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorySubscription extends Model
{
    use HasFactory;

    protected $fillable = [
        "plan_type_id",
        "user_id",
        "type",
        "start_date",
        "end_date",
        "actual_price",
        "discount_price"
    ];
}
