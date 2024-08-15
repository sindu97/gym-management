<?php

namespace App\Http\Controllers\Api\Plan;

use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Plan\PlanRequest;
use App\Models\Plan;
use App\Services\Plan\PlanService;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PlanController extends Controller
{

    public function __construct(
        protected PlanService $planService
    ) {}


    public function index(PlanRequest $request)
    {
        dd('here');
        // try {
        //     $plan =  Plan::create($request->all());
        //     return response()->json(['message' => 'Data Successfully Fetched', 'data' => $plan], Response::HTTP_CREATED);
        // } catch (Exception $e) {
        //     throw new CustomException('Something Went Wrong', Response::HTTP_BAD_REQUEST);
        // }
    }


    public function create(PlanRequest $request)
    {
        try {
            $plan =  Plan::create($request->all());
            return response()->json(['message' => 'Data Successfully Fetched', 'data' => $plan], Response::HTTP_CREATED);
        } catch (Exception $e) {
            throw new CustomException('Something Went Wrong', Response::HTTP_BAD_REQUEST);
        }
    }
}
