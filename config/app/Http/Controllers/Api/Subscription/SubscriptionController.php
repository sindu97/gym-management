<?php

namespace App\Http\Controllers\Api\Subscription;

use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Subscription\Subscriptionrequest;
use App\Mail\RegistrationMail;
use App\Models\User;
use App\Services\SmsService;
use App\Services\WhatsAppService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class SubscriptionController extends Controller
{


    protected $whatsAppService;
    protected $smsService;

    public function __construct(WhatsAppService $whatsAppService, SmsService $smsService)
    {
        $this->whatsAppService = $whatsAppService;
        $this->smsService = $smsService;
    }
    /**
     * @param Subscriptionrequest $request
     * @since 17/01/2024
     * @author Surinder rana < Sindu.97@gmail.com>
     * This gives the Listing of the Plans
     */

    public function index(Subscriptionrequest $request)
    {
        try {
            $perPage = $request->input('per_page', 10);
            $sortBy = $request->input('sort', 'updated_at');
            $direction = $request->input('direction', 'desc');
            $plans =  User::when($request->filled('status'), function ($query) use ($request) {
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
     * @param Subscriptionrequest $request
     * @since 17/01/2024
     * @author Surinder rana < Sindu.97@gmail.com>
     * This function create the subscription
     */
    public function create(Subscriptionrequest $request)
    {

        $to = '+919805043060';  // The recipient's WhatsApp number
        $message = 'message hum mein';  // The message content

        $this->whatsAppService->sendMessage($to, $message);
        $this->smsService->sendMessage($to, $message);


        exit;
        //send text to the user phone number //
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
            $to = '+919639603764';  // The recipient's WhatsApp number
            $message = 'message hum mein';  // The message content

            $this->whatsAppService->sendMessage($to, $message);
            // Send welcome email to user
            // Mail::to('test123@yopmail.com')->send(new RegistrationMail($user));
            // return response()->json(['message' => __('plan.subscribed_success'), 'data' => $user], Response::HTTP_CREATED);
        } catch (Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            throw new CustomException(['message' => __('common.something_went'), 'error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
