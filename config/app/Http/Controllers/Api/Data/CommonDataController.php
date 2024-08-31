<?php

namespace App\Http\Controllers\Api\Data;

use App\Enum\Status;
use App\Http\Controllers\Controller;
use App\Http\Requests\Common\CommonDataRequest;
use App\Models\PlanType;
use Illuminate\Support\Str;

class CommonDataController extends Controller
{
    /**
     * @param CommonDataRequest $request
     * @since 17/01/2024
     * @author Surinder rana < Sindu.97@gmail.com>
     * This function returns all the common data in items
     */
    public function userCommon(CommonDataRequest $request)
    {
        $response = [];
        $items = Str::of($request->input('items'))->split('/[\s,]+/');
        if ($items->contains('plan_types')) {
            $response['plan_types'] = PlanType::where('status', Status::ACTIVE)->select('id', 'name', 'slug')->get();
        }
        return [
            'message' => __('common.data_fetched'),
            'data' => $response
        ];
    }
}
