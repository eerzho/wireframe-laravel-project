<?php

namespace App\Traits;

trait ResponseTrait
{
    /**
     * @param array $data
     * @param int   $code
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function response(array $data, int $code = 200)
    {
        return response()->json($data, $code);
    }
}
