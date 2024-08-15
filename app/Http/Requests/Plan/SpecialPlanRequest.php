<?php

namespace App\Http\Requests\Plan;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\BaseFromRequest;

class SpecialPlanRequest extends BaseFromRequest
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
            'name' => 'required|string',
            'prices' => 'required|array',
            // 'plan_type_id' => 'required|exists:plan_types,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'template_id' => 'numeric|required',
        ];
    }
}
