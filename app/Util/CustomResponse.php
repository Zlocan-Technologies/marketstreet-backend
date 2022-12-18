<?php

namespace App\Util;

class CustomResponse
{
    static function coreResponse($message, $data = null, $statusCode, $isSuccess = true)
    {
        // Check the params
        if(!$message) return response()->json(['message' => 'Message is required'], 500);

        // Send the response
        if($isSuccess):
            return response()->json([
                'message' => $message,
                'results' => $data,
                'error' => false,
            ], $statusCode);
        else:
            return response()->json([
                'message' => $message,
                'error' => true,
            ], $statusCode);
        endif;
    }

    static function success($message, $data, $statusCode = 200)
    {
        return self::coreResponse($message, $data, $statusCode);
    }

    static function error($message, $statusCode = 500)
    {
        return self::coreResponse($message, null, $statusCode, false);
    }
}