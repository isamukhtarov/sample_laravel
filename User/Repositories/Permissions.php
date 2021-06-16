<?php

declare(strict_types=1);

namespace Modules\User\Repositories;

use Nwidart\Modules\Facades\Module;

class Permissions
{
    public static function all(): array
    {
        return static::getEnableModulesPermissions();
    }

    private static function getEnableModulesPermissions(): array
    {
        $permissions = [];

        foreach (Module::allEnabled() as $module) {
            $config = config('app.modules.' .strtolower($module->getName()) .'.permissions');

            if (!is_null($config)) {
                $permissions[$module->getName()] = $config;
            }
        }

        return $permissions;
    }
}
