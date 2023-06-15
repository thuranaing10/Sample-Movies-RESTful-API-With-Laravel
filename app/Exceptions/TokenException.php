<?php

namespace App\Exceptions;

use Exception;

class TokenException extends Exception
{
    public function render($request)
    {
        return response()->json([
            'success' => false,
            'message'=> $this->getMessage(),
            'data' => null,
        ], config('http_status.unauthorized'));
    }
}
