<?php

declare(strict_types=1);

namespace Modules\User\Transformers\Resource;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\User\Entities\Permission;

class PermissionResource extends JsonResource
{
    public function toArray($request): array
    {
        /** @var Permission $this */
        $display_name = is_string($this->display_name) ? json_decode($this->display_name, true) : $this->display_name;

        return [
            'id' => $this->id,
            'display_name' => $display_name,
            'name' => $this->name,
            'isChecked' => false
        ];
    }
}
