<?php

namespace App\Http\Controllers\Api\Data;

use App\Http\Controllers\Controller;
use App\Models\PlanType;
use Illuminate\Http\Request;

class CommonDataController extends Controller
{
    public function userCommon(Request $request)
    {

        dd($request->all());

        $PlanType = PlanType::get();
    }
}
