<?php

declare(strict_types=1);

namespace Modules\User\Transformers\Resource;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Modules\User\Entities\Role;

class RoleResource extends JsonResource
{
    public function toArray($request): array
    {
        /** @var Role $this */
        $display_name = is_string($this->display_name) ? json_decode($this->display_name, true) : $this->display_name;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'display_name' => $display_name,
            'color' => $this->color,
            'permissions' => PermissionResource::collection($this->permissions)
        ];
    }
}
