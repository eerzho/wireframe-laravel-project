<?php

namespace App\Http\Controllers\Api\V1\Role;

use App\Constants\Messages\ExceptionMessage;
use App\Exceptions\NotDoneException;
use App\Http\Requests\Role\RoleUpdateRequest;
use App\Http\Resources\Role\RoleResource;
use App\Models\Role\Role;
use App\Repositories\Role\RoleRepository;
use App\Services\Role\RoleUpdateService;
use Eerzho\LaravelComponents\Components\Request\DataTransfer;
use Eerzho\LaravelComponents\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * @property RoleRepository $roleRepository
 */
class RoleController extends Controller
{
    private RoleRepository $roleRepository;

    /**
     * @param RoleRepository $roleRepository
     */
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->middleware('begin.transaction')->only('update');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $builder = $this->roleRepository->search($request)->getQuery();

        return RoleResource::collection($builder->paginate());
    }

    /**
     * @param Role $role
     *
     * @return RoleResource
     */
    public function show(Role $role)
    {
        return new RoleResource($role);
    }

    /**
     * @param RoleUpdateRequest $request
     * @param Role              $role
     *
     * @return RoleResource
     * @throws NotDoneException
     */
    public function update(RoleUpdateRequest $request, Role $role)
    {
        $isSave = (new RoleUpdateService($role, new DataTransfer($request->validated())))->run();

        if ($isSave) {

            DB::commit();

            return new RoleResource($role->refresh());
        }

        throw new NotDoneException(ExceptionMessage::FAIL_UPDATE);
    }
}
