<?php

namespace App\Http\Controllers\Api\Verify;

use App\Constants\Messages\ExceptionMessage;
use App\Exceptions\NotDoneException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Verify\EmailVerificationRequest;
use App\Models\User\User;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only(['resend']);
    }

    /**
     * @param EmailVerificationRequest $request
     * @param                          $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function verify(EmailVerificationRequest $request, $id)
    {
        $request->fulfill();

        return view('welcome');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws NotDoneException
     */
    public function resend()
    {
        /** @var User $user */
        $user = Auth::user();

        $res = !$user->hasVerifiedEmail();

        if ($res) {
            $user->sendEmailVerificationNotification();

            return $this->response([]);
        }

        throw new NotDoneException(ExceptionMessage::EMAIL_VERIFIED);
    }
}
