<?php

declare(strict_types=1);

namespace Modules\User\Transformers\Resource\Customer;

use Modules\Settings\Transformers\BlockReasonResource;
use Modules\User\Entities\Customer;

class CustomerDetailResource extends CustomerResource
{
    public function toArray($request): array
    {
        /** @var Customer $this */
        $data = [
            'note' => !empty($this->note) ? $this->note : '',
            'city' => $this->city,
            'contacts' => $this->contacts,
            'email_notify_info' => $this->email_notify_info,
            'sms_notify_info' => $this->sms_notify_info
        ];

        if (!empty($request->id)){
            $data['block_reason'] = !empty($this->block->reason) ? new BlockReasonResource($this->block->reason) : [];
            $data['block_description'] = !empty($this->block->description) ? $this->block->description : "";
        }

        return array_merge(parent::toArray($request), $data);
    }
}
