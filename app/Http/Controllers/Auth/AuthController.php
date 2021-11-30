<?php

namespace App\Http\Controllers\Auth;

use App\Components\Request\DataTransfer;
use App\Constants\Messages\ExceptionMessage;
use App\Events\DeleteToken;
use App\Exceptions\NotDoneException;
use App\Exceptions\UnauthorizedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthForgotRequest;
use App\Http\Requests\Auth\AuthLoginRequest;
use App\Http\Requests\Auth\AuthResetRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User\User;
use App\Repositories\User\UserRepository;
use App\Services\Auth\TokenStoreService;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('begin.transaction')->only(['login', 'logout']);
    }

    /**
     * @return UserResource
     */
    public function me()
    {
        return new UserResource(Auth::user());
    }

    /**
     * @param AuthLoginRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws UnauthorizedException
     */
    public function login(AuthLoginRequest $request)
    {
        /** @var User $user */
        if ($username = $request->post('username')) {
            $user = app(UserRepository::class)->getByUsername($username);
        } elseif ($email = $request->post('email')) {
            $user = app(UserRepository::class)->getByEmail($email);
        }

        $tokenStoreService = new TokenStoreService(
            new PersonalAccessToken(),
            new DataTransfer(['user_agent' => $request->server('HTTP_USER_AGENT')]),
            $user
        );

        $res = Hash::check($request->post('password'), $user->password);
        $res = $res && $tokenStoreService->run();

        if ($res) {

            DB::commit();

            return $this->response([
                'type'  => 'Bearer',
                'token' => $tokenStoreService->getPlainTextToken(),
            ]);
        }

        throw new UnauthorizedException(ExceptionMessage::INVALID_PASSWORD);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws NotDoneException
     */
    public function logout()
    {
        /** @var User $user */
        $user = Auth::user();

        /** @var PersonalAccessToken $token */
        $token = $user->currentAccessToken();

        if ($token->delete()) {
            DB::commit();

            return $this->response([]);
        }

        throw new NotDoneException(ExceptionMessage::FAIL_LOGOUT);
    }

    /**
     * @param AuthForgotRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws NotDoneException
     */
    public function forgot(AuthForgotRequest $request)
    {
        $res = Password::sendResetLink($request->validated());

        if ($res === Password::RESET_LINK_SENT) {

            return $this->response([]);
        }

        throw new NotDoneException(ExceptionMessage::FAIL_SEND_EMAIL);
    }

    /**
     * @param AuthResetRequest $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws NotDoneException
     */
    public function reset(AuthResetRequest $request)
    {
        $res = Password::reset($request->post(), function (User $user, $password) {
            $user->password = Hash::make($password);
            $user->save();

            event(new PasswordReset($user));
            event(new DeleteToken($user));
        });

        if ($res == Password::INVALID_TOKEN) {
            throw new NotDoneException(ExceptionMessage::INVALID_TOKEN);
        }

        return view('welcome');
    }
}
