<?php

declare(strict_types=1);

namespace Modules\User\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Modules\User\Entities\User;

class PasswordRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        /** @var User $user */
        $user = auth()->user();

        if ((Hash::check($value, $user->password)) === false) {
            return false;
        }

        return true;
    }

    public function message(): string
    {
        return 'Old password is incorrect';
    }
}
