<?php

namespace App\Http\Controllers\Api\Plan;

use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Plan\PlanRequest;
use App\Models\Plan;
use App\Services\Plan\PlanService;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class PlanController extends Controller
{

    public function __construct(
        protected PlanService $planService
    ) {}

    /**
     * @param PlanRequest $request
     * @since 17/01/2024
     * @author Surinder rana < Sindu.97@gmail.com>
     * This gives the Listing of the Plans
     */

    public function index(PlanRequest $request)
    {
        try {
            $perPage = $request->input('per_page', 10);
            $sortBy = $request->input('sort', 'updated_at');
            $direction = $request->input('direction', 'desc');
            $plans =    Plan::when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })->when($request->filled('keyword'), function ($query) use ($request) {
                $keyword = "%{$request->keyword}%";
                $query->where(function ($query) use ($keyword) {
                    $query->orWhere('name', 'like', $keyword);
                });
            })->orderBy($sortBy, $direction)
                ->paginate($perPage);
            return response()->json(['message' =>   __('common.data_fetched'), 'data' => $plans], Response::HTTP_CREATED);
        } catch (Exception $e) {
            throw new CustomException(['message' => __('common.something_went'), 'error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @param PlanRequest $request
     * @since 17/01/2024
     * @author Surinder rana < Sindu.97@gmail.com>
     * This gives the detail of the Plan
     */

    public function getdetail(PlanRequest $request)
    {
        try {
            $plans =    Plan::where('id', $request->id)->select('id', 'name', 'plan_type_id', 'status', 'price')->first();
            return response()->json(['message' => __('common.data_fetched'), 'data' => $plans], Response::HTTP_OK);
        } catch (Exception $e) {
            throw new CustomException(['message' => __('common.something_went'), 'error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @param PlanRequest $request
     * @since 17/01/2024
     * @author Surinder rana < Sindu.97@gmail.com>
     * This update the status of the Plans
     */

    public function statusUpdate(PlanRequest $request)
    {
        try {
            $plans = Plan::where('id', $request->id)->update($request->all());
            return response()->json(['message' => __('plan.status_update'), 'data' => $plans], Response::HTTP_OK);
        } catch (Exception $e) {
            throw new CustomException(['message' => __('common.something_went'), 'error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }


    /**
     * @param PlanRequest $request
     * @since 17/01/2024
     * @author Surinder rana < Sindu.97@gmail.com>
     * This function create the Plans
     */

    public function create(PlanRequest $request)
    {
        try {
            $plan =  Plan::create($request->all());
            return response()->json(['message' => __('plan.plan_created'), 'data' => $plan], Response::HTTP_CREATED);
        } catch (Exception $e) {
            throw new CustomException(['message' => __('common.something_went'), 'error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
