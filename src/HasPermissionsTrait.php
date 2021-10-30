<?php

namespace Attla\Permission;

use Attla\Permission\Models\Role;

trait HasPermissionsTrait
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getRolesAttribute()
    {
        return $this->roles()->get(['id', 'name']);
    }

    /**
     * Check if has a role
     *
     * @param mixed ...$roles
     * @return bool
     */
    public function hasRole(...$roles)
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('name', $role)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if has a permission
     *
     * @param string $permission
     * @return bool
     */
    public function hasPermission($permission)
    {
        $hasPermission = false;

        foreach ($this->roles as $role) {
            if ($hasPermission = $role->hasPermission($permission)) {
                break;
            }
        }

        return $hasPermission;
    }
}
