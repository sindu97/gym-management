<?php

namespace App\Http\Controllers\Api\Plan;

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

            return response()->json(['message' => 'Plan Created successfully', 'data' => $specialPackage], Response::HTTP_CREATED);
        } catch (Exception $e) {
            DB::rollback();
            dd('here');
        }
    }
}
