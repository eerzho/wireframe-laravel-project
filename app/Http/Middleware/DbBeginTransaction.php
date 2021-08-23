<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class DbBeginTransaction
{
    /**
     * @param Request  $request
     * @param \Closure $next
     *
     * @return mixed
     * @throws \Throwable
     */
    public function handle(Request $request, \Closure $next)
    {
        DB::beginTransaction();

        /** @var JsonResponse $response */
        $response = $next($request);

        if ($response->exception) {
            DB::rollBack();
            throw $response->exception;
        }

        return $response;
    }
}
