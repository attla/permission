<?php

namespace Attla\Permission\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'permission_group_id',
        'name',
        'identifier'
    ];

    protected $hidden = [
        'pivot'
    ];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(PermissionGroup::class);
    }
}
