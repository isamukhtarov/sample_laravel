<?php

declare(strict_types=1);

namespace Modules\User\Rules;

use Illuminate\Contracts\Validation\Rule;

class SpaceRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        if (is_null($value))
            return true;

        return (strpos($value, ' ') !== false) ? false : true;
    }

    /**
     * @return string|array
     */
    public function message()
    {
        return trans('core::validation.space');
    }
}
