<?php

namespace App\Http\Controllers\Api\Subscription;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subscription\Subscriptionrequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class SubscriptionController extends Controller
{

    public function create(Subscriptionrequest $request)
    {
        try {
            DB::beginTransaction();
            $requestData = $request->all();
            $extraData = ['password' => Hash::make('Test@1234')];
            $totalData = array_merge($requestData, $extraData);
            $user =  User::create($totalData);
            $user->roleUser()->create($totalData);
            $user->userProfile()->create($totalData);
            $user->subscriptions()->create($totalData);
            $user->subscriptionsHistory()->create($totalData);
            DB::commit();
            return response()->json(['message' => 'Client Created successfully', 'data' => $user], Response::HTTP_CREATED);
        } catch (Exception $e) {
            DB::rollback();
            dd('here');
        }
    }
}
