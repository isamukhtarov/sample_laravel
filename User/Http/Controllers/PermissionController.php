<?php

declare(strict_types=1);

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Core\Http\Controllers\ApiController;
use Modules\User\Entities\Permission;
use Modules\User\Transformers\Resource\PermissionResource;

class PermissionController extends ApiController
{
    /**
     * @OA\Get(
     *      tags={"Permissions"},
     *      path="/api/permissions",
     *      summary="Get permissions data",
     *      description="Returns permissions data",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       )
     * )
     */
    public function index(): AnonymousResourceCollection
    {
        $permissions = Permission::query()->orderBy('id')->get();
        return PermissionResource::collection($permissions);
    }
}
