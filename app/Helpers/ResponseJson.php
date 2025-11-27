<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ResponseJson
{
    public const int ERROR_CODE = 500;


    /**
     * Ошибка ajax
     *
     * @param string $message
     * @param int $code
     *
     * @return JsonResponse
     */
    public static function ajaxError(string $message, int $code = self::ERROR_CODE): JsonResponse
    {
        return response()->json(['message' => $message], $code);
    }

}
