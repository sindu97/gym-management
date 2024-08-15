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
        return true;
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
