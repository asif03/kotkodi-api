<?php

namespace App\Http\Service;

use App\Http\Repository\RoleRepository;
use App\Http\Resources\RoleCollection;
use App\Http\Resources\RoleResource;
use App\Traits\RespondsWithHttpStatus;
use Illuminate\Http\Response;

class RoleService
{
    use RespondsWithHttpStatus;

    public function index()
    {
        $role = RoleRepository::index();
        return $this->success(new RoleCollection($role), Response::HTTP_OK);
    }

    /**
     * @OA\Schema(
     *      schema="Role",
     *      title="Create New Role",
     *      description="Role create request body",
     *      type="object",
     *      required={"name", "permission"},
     *      @OA\Property(
     *          property="name",
     *          description="Name of Role",
     *          example="Super Admin",
     *          type="string"
     *      ),
     *      @OA\Property(
     *          property="permission",
     *          description="Permission against role",
     *          type="array",
     *          @OA\Items(
     *              @OA\Property(
     *                  property="name",
     *                  type="string",
     *                  example="country-list"
     *              ),
     *              @OA\Property(
     *                  property="name",
     *                  type="string",
     *                  example="country-create"
     *              )
     *          ),
     *      )
     * )
     */
    public function create($request)
    {
        $role = RoleRepository::store($request);

        if ($role) {
            return $this->success(trans('messages.create'), Response::HTTP_CREATED);
        }

    }

    public function update($request)
    {
        $role = RoleRepository::findById($request->id);

        if (!$role) {
            return $this->success(trans('messages.notFound'), Response::HTTP_NOT_FOUND);
        }

        if ($role) {
            $isUpdate = RoleRepository::update($request, $role);

            if ($isUpdate) {
                return $this->success(trans('messages.update'), Response::HTTP_OK);
            }

        }

    }

    public function show($id)
    {
        $role = RoleRepository::findById($id);

        if (!$role) {
            return $this->success(trans('messages.notFound'), Response::HTTP_NOT_FOUND);
        }

        return $this->success(new RoleResource($role), Response::HTTP_OK);
    }

    public function delete($id)
    {
        $role = RoleRepository::findById($id);

        if (!$role) {
            return $this->success(trans('messages.notFound'), Response::HTTP_NOT_FOUND);
        }

        return $this->success(RoleRepository::delete($role));
    }

}