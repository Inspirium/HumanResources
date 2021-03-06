<?php

namespace Inspirium\HumanResources\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Inspirium\HumanResources\Models\Role
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property-read \Illuminate\Database\Eloquent\Collection|\Inspirium\UserManagement\Models\User[] $users
 * @method static \Illuminate\Database\Eloquent\Builder|\Inspirium\UserManagement\Models\Role whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Inspirium\UserManagement\Models\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Inspirium\UserManagement\Models\Role whereName($value)
 * @mixin \Eloquent
 */
class Role extends Model {

    public $timestamps = false;

    protected $fillable = ['name', 'description'];

    public function users() {
        return $this->belongsToMany('Inspirium\HumanResources\Models\Employee', 'users_roles');
    }
}
