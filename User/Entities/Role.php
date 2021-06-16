<?php

declare(strict_types=1);

namespace Modules\User\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as SpatieRole;
use Modules\User\Database\factories\RoleFactory;

/**
 * @property int id
 * @property string name
 * @property string guard_name
 * @property array display_name
 * @property string color
 * @property Permission permissions
 * @property Carbon|null created_at
 * @property Carbon|null updated_at
 */
class Role extends SpatieRole
{
    use HasFactory;

    protected $table = 'roles';
    protected $fillable = ['display_name', 'guard_name', 'name', 'color'];

    protected $casts = [
        'display_name' => 'array'
    ];

    protected static function newFactory(): RoleFactory
    {
        return RoleFactory::new();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function setDisplayName(array $display_name): self
    {
        $this->display_name = $display_name;
        return $this;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;
        return $this;
    }

    public function getDisplayNameAttribute($value)
    {
        return json_decode($value,true);
    }
}
