<?php

namespace App\Http\Controllers\Api\Auth;

use App\Exceptions\UnauthorizedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthLoginRequest;
use App\Http\Resources\User\UserResource;
use App\Messages\ExceptionMessage;
use App\Models\User\User;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only('me');
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
        $data = [];
        if ($request->has('username')) {
            $data['username'] = $request->get('username');
        } elseif ($request->has('email')) {
            $data['email'] = $request->get('email');
        }
        $data['password'] = $request->get('password');

        if (Auth::attempt($data)) {
            $userRepository = app(UserRepository::class);

            /** @var User $user */
            $user = array_key_exists('username', $data) ?
                $userRepository->getByUsername($data['username']) :
                $userRepository->getByEmail($data['email']);

            return $this->response([
                'type'  => 'Bearer',
                'token' => $user->createToken($request->server('HTTP_USER_AGENT'))->plainTextToken,
            ]);
        }

        throw new UnauthorizedException(ExceptionMessage::FAIL_AUTH);
    }
}
