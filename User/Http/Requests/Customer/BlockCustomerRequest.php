<?php

namespace Modules\User\Http\Requests\Customer;

use Illuminate\Validation\Rule;
use Modules\Core\Http\Requests\FormRequest;

class BlockCustomerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'reason_id' => ['required', 'int', Rule::exists('block_reasons', 'id')],
            'description' => 'nullable|string'
        ];
    }
}
