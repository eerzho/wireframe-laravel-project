<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ResponseTrait
{
    /**
     * @param array $data
     * @param int   $code
     *
     * @return JsonResponse
     */
    public function response(array $data, int $code = 200)
    {
        return response()->json([
            'data' => $data
        ], $code);
    }
}
