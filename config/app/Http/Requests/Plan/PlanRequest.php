<?php

namespace App\Http\Requests\Plan;

use App\Http\Requests\BaseFromRequest;


class PlanRequest extends BaseFromRequest
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
     * This validate the create plan request
     */

    private function createValidation(): array
    {
        return [
            'name' => 'required|string|unique:plans,name',
            'plan_type_id' => 'required|exists:plan_types,id',
            'price' => 'numeric|required',
            'discounted_price' => 'numeric|required',
        ];
    }
}
