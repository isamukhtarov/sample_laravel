<?php

declare(strict_types=1);

namespace Modules\User\Handlers\Traits;

trait PreparePermissions
{
    public function prepare(array $permissions): array
    {
        $preparedPermissions = [];

        foreach ($permissions as $name => $value) {
            if (is_null($value) || is_bool($value)) {
                $preparedPermissions[$name] = $value;

                continue;
            }

            if (!is_null(static::value($value))) {
                $preparedPermissions[$name] = static::value($value);
            }
        }

        return $preparedPermissions;
    }

    /**
     * @param string $permission
     * @return bool|null
     */
    protected static function value(string $permission)
    {
        if ($permission === '1')
            return true;

        if ($permission === '-1')
            return false;
    }
}
