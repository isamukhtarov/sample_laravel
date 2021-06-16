<?php

declare(strict_types=1);

namespace Modules\User\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\User\Entities\User;

class UserRepository
{
    public static function getUsersWithRoles(int $perPage): LengthAwarePaginator
    {
        return User::query()
            ->with('roles')
            ->with('permissions')
            ->orderBy('id')
            ->paginate($perPage);
    }
}
