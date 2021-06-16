<?php

namespace Modules\User\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as SpatiePermission;

/**
 * @property int id
 * @property string name
 * @property string guard_name
 * @property array display_name
 * @property Carbon|null created_at
 * @property Carbon|null updated_at
 */
class Permission extends SpatiePermission
{
    use HasFactory;

    protected $table = 'permissions';

    protected $casts = [
        'display_name' => 'array'
    ];
}
