<?php

namespace App\Http\Controllers\Api\Plan;

use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Plan\SpecialPlanRequest;
use App\Models\SpecialPackage;
use App\Models\specialPlanPrice;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class SpecialPlanController extends Controller
{
    /**
     * @param PlanRequest $request
     * @since 17/01/2024
     * @author Surinder rana < Sindu.97@gmail.com>
     * This gives the Listing of the Special Plans
     */

    public function index(SpecialPlanRequest $request)
    {
        try {
            $perPage = $request->input('per_page', 10);
            $sortBy = $request->input('sort', 'updated_at');
            $direction = $request->input('direction', 'desc');
            $plans =    SpecialPackage::when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })->when($request->filled('keyword'), function ($query) use ($request) {
                $keyword = "%{$request->keyword}%";
                $query->where(function ($query) use ($keyword) {
                    $query->orWhere('name', 'like', $keyword);
                });
            })->with('specialPrice')->orderBy($sortBy, $direction)
                ->paginate($perPage);
            return response()->json(['message' =>  __('common.data_fetched'), 'data' => $plans], Response::HTTP_CREATED);
        } catch (Exception $e) {
            throw new CustomException(['message' => __('common.something_went'), 'error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @param PlanRequest $request
     * @since 17/01/2024
     * @author Surinder rana < Sindu.97@gmail.com>
     * This gives the detail of the special Plan
     */

    public function getdetail(SpecialPlanRequest $request)
    {
        try {
            $plans =    SpecialPackage::where('id', $request->id)->select('id', 'name', 'start_date', 'end_date', 'template_id')->with('specialPrice')->first();
            return response()->json(['message' =>  __('common.data_fetched'), 'data' => $plans], Response::HTTP_OK);
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

    public function statusUpdate(SpecialPlanRequest $request)
    {
        try {
            $plans = SpecialPackage::where('id', $request->id)->update($request->all());
            return response()->json(['message' =>  __('plan.status_update'), 'data' => $plans], Response::HTTP_OK);
        } catch (Exception $e) {
            throw new CustomException(['message' => __('common.something_went'), 'error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @param PlanRequest $request
     * @since 17/01/2024
     * @author Surinder rana < Sindu.97@gmail.com>
     * This function create the special Plans
     */

    public function create(SpecialPlanRequest $request)
    {
        try {
            DB::beginTransaction();
            $requestData = $request->all();
            $extraData = ['slug' => Str::snake($request->name)];
            $totalData = array_merge($requestData, $extraData);
            $specialPackage = SpecialPackage::create($totalData);
            foreach ($requestData['prices'] as $priceData) {
                $data = [
                    'special_package_id' => $specialPackage->id,
                    'plan_type_id' => $priceData['plan_id'],
                    'slug' => $priceData['slug'],
                    'price' => $priceData['price'],
                ];
                specialPlanPrice::create($data);
            }
            DB::commit();
            return response()->json(['message' => __('plan.plan_created'), 'data' => $specialPackage], Response::HTTP_CREATED);
        } catch (Exception $e) {
            DB::rollback();
            throw new CustomException(['message' => __('common.something_went'), 'error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
