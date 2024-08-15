<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class CustomException extends Exception
{
    protected $statusCode;

    public function __construct($message, $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR)
    {
        parent::__construct($message);
        $this->statusCode = $statusCode;
    }

    public function render($request)
    {
        return response()->json(['message' => $this->getMessage()], $this->statusCode);
    }
}
