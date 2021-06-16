<?php

declare(strict_types=1);

namespace Modules\User\Transformers\Resource;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\User\Entities\User;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request): array
    {
        /** @var User $this */
        return [
            'id' => $this->id,
            'email' => $this->email,
            'full_name' => $this->full_name,
            'username' => $this->username,
            'phone' => $this->phone,
            'roles' => RoleResource::collection($this->roles),
            'permissions' => PermissionResource::collection($this->permissions)
        ];
    }
}
