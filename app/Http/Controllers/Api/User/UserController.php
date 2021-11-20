<?php

namespace App\Http\Controllers\Api\User;

use App\Components\Request\DataTransfer;
use App\Exceptions\NotDoneException;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdatePasswordRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User\User;
use App\Repositories\User\UserRepository;
use App\Services\User\UserStoreService;
use App\Services\User\UserUpdatePasswordService;
use App\Services\User\UserUpdateService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * @property UserRepository $userRepository
 */
class UserController extends Controller
{
    private UserRepository $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->middleware('begin.transaction')
            ->only(['store', 'update', 'destroy', 'updatePassword']);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $builder = $this->userRepository->search($request)->getQuery();

        return UserResource::collection($builder->paginate());
    }

    /**
     * @param UserStoreRequest $request
     * @param User             $user
     *
     * @return UserResource
     * @throws NotDoneException
     */
    public function store(UserStoreRequest $request, User $user)
    {
        $isSave = (new UserStoreService($user, new DataTransfer($request->validated())))->run();

        if ($isSave) {

            DB::commit();

            return new UserResource($user->refresh());
        }

        throw new NotDoneException('Не удалось сохранить');
    }

    /**
     * @param User $user
     *
     * @return UserResource
     */
    public function show(User $user)
    {
        return new  UserResource($user);
    }

    /**
     * @param UserUpdateRequest $request
     * @param User              $user
     *
     * @return UserResource
     * @throws NotDoneException
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $isSave = (new UserUpdateService($user, new DataTransfer($request->validated())))->run();

        if ($isSave) {

            DB::commit();

            return new UserResource($user->refresh());
        }

        throw new NotDoneException('Не удалось сохранить');
    }

    /**
     * @param User $user
     *
     * @return JsonResponse
     * @throws NotDoneException
     */
    public function destroy(User $user)
    {
        if ($user->delete()) {

            DB::commit();

            return $this->response([]);
        }

        throw new NotDoneException('Не удалось удалить');
    }

    /**
     * @param UserUpdatePasswordRequest $request
     * @param User                      $user
     *
     * @return JsonResponse
     * @throws NotDoneException
     */
    public function updatePassword(UserUpdatePasswordRequest $request, User $user)
    {
        $isSave = (new UserUpdatePasswordService($user, new DataTransfer($request->validated())))->run();

        if ($isSave) {

            DB::commit();

            return $this->response([]);
        }

        throw new NotDoneException('Не удалось изменить пароль');
    }
}
