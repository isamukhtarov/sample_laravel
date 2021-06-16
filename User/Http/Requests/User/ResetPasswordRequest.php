<?php

declare(strict_types=1);

namespace Modules\User\Http\Requests\User;

use Modules\Core\Http\Requests\FormRequest;
use Modules\User\Rules\PasswordRule;

class ResetPasswordRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'old' => ['required', new PasswordRule],
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required|same:password',
        ];
    }
}
