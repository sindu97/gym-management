<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract  class BaseFromRequest extends FormRequest
{

    protected function failedValidation(Validator $validator)
    {

        $errors = $validator->errors()->messages(); // Get all error messages with field keys
        $formattedErrors = [];
        foreach ($errors as $field => $messages) {
            // Combine all messages for the field into a single string
            $formattedErrors[$field] = implode(' ', $messages);
        }
        throw new HttpResponseException(response()->json([
            'errors' => $errors,
        ], 422));
    }
}
