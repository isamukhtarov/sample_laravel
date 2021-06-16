<?php

declare(strict_types=1);

namespace Modules\User\Http\Requests\User;

use Modules\Core\Http\Requests\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => 'required|string',
            'password' => 'required|min:4|string'
        ];
    }
}
