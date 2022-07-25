<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name'
    ];

    protected $appends = [
        'permissions'
    ];

    public const UPDATED_AT = null;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function getPermissionsAttribute()
    {
        return $this->permissions()->get(['id', 'name', 'identifier']);
    }

    /**
     * Check if has a permission
     *
     * @param string $identifier
     * @return bool
     */
    public function hasPermission(string $identifier)
    {
        return $this->permissions->contains('identifier', $identifier);
    }
}
