<?php

namespace App\Http\Requests\Subscription;

use App\Http\Requests\BaseFromRequest;
use Illuminate\Foundation\Http\FormRequest;

class Subscriptionrequest extends BaseFromRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return isCompanyAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $methodName = $this->route()->getActionMethod();
        return match ($methodName) {
            'create' => $this->createValidation(),
            default => [],
        };
    }

    /**
     * @since 17/01/2024
     * @author Surinder rana < Sindu.97@gmail.com>
     * This validate the subscription request
     */
    private function createValidation(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'country_code' => 'required',
            'phone' => 'required|integer',
            'address' => 'nullable|string',
            'state' => 'nullable|string',
            'city' => 'nullable|string',
            'country' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'actual_price' => 'numeric|required',
            'discount_price' => 'numeric|required',
            'additional_days' => 'nullable|integer',
            'discount_percentage' => 'nullable|numeric',
            'type' => "required",
            'plan_type_id' => "required",
        ];
    }
}
