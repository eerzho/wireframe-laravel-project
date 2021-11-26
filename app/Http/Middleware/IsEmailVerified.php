<?php

namespace App\Http\Middleware;

use App\Constants\Messages\ExceptionMessage;
use App\Exceptions\NotDoneException;
use App\Models\User\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsEmailVerified
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     * @throws NotDoneException
     */
    public function handle(Request $request, Closure $next)
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            return $next($request);
        }

        throw new NotDoneException(ExceptionMessage::EMAIL_NOT_VERIFIED);
    }
}
