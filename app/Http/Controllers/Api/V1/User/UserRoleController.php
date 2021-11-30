<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Components\Request\DataTransfer;
use App\Constants\Messages\ExceptionMessage;
use App\Exceptions\NotDoneException;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRoleAttachRequest;
use App\Http\Requests\User\UserRoleDetachRequest;
use App\Models\User\User;
use App\Services\User\UserRoleAttachService;
use App\Services\User\UserRoleDetachService;
use Illuminate\Support\Facades\DB;

class UserRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('begin.transaction');
    }

    /**
     * @param UserRoleAttachRequest $request
     * @param User                  $user
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws NotDoneException
     */
    public function attach(UserRoleAttachRequest $request, User $user)
    {
        $isSave = (new UserRoleAttachService($user, new DataTransfer($request->validated())))->run();

        if ($isSave) {

            DB::commit();

            return $this->response([]);
        }

        throw new NotDoneException(ExceptionMessage::FAIL_UPDATE);
    }

    /**
     * @param UserRoleDetachRequest $request
     * @param User                  $user
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws NotDoneException
     */
    public function detach(UserRoleDetachRequest $request, User $user)
    {
        $isSave = (new UserRoleDetachService($user, new DataTransfer($request->validated())))->run();

        if ($isSave) {

            DB::commit();

            return $this->response([]);
        }

        throw new NotDoneException(ExceptionMessage::FAIL_UPDATE);
    }
}
