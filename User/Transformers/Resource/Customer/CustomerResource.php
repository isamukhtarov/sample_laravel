<?php

declare(strict_types=1);

namespace Modules\User\Transformers\Resource\Customer;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\User\Entities\Customer;

class CustomerResource extends JsonResource
{
    public function toArray($request): array
    {
        /** @var Customer $this */
        return [
            'id' => $this->id,
            'email' => $this->email,
            'full_name' => $this->full_name,
            'avatar' => $this->avatar !== 'default.png' ? \Storage::disk('avatars')->url($this->avatar) : asset('avatar/default.png'),
            'phone' => $this->phone,
            'last_login' => !empty($this->last_login) ? Carbon::parse($this->last_login)->format('Y-m-d H:i:s') : null,
            'is_blocked' => $this->is_blocked
        ];
    }
}
