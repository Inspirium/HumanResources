<?php

namespace Inspirium\HumanResources\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


/**
 * Inspirium\HumanResources\Models\Employee
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $email
 * @property int|null $user_id
 * @property int|null $department_id
 * @property string|null $image
 * @property string|null $mobile_pre
 * @property string|null $mobile
 * @property string|null $mobile_vpn
 * @property string|null $phone_pre
 * @property string|null $phone
 * @property string|null $phone_vpn
 * @property string|null $address
 * @property string|null $city
 * @property string|null $postal_code
 * @property string|null $room
 * @property string|null $sex
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Inspirium\HumanResources\Models\Department|null $department
 * @property-read mixed $department_name
 * @property-read mixed $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\Inspirium\TaskManagement\Models\Task[] $tasks
 * @property-read \Inspirium\UserManagement\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\Inspirium\HumanResources\Models\Employee whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Inspirium\HumanResources\Models\Employee whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Inspirium\HumanResources\Models\Employee whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Inspirium\HumanResources\Models\Employee whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Inspirium\HumanResources\Models\Employee whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Inspirium\HumanResources\Models\Employee whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Inspirium\HumanResources\Models\Employee whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Inspirium\HumanResources\Models\Employee whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Inspirium\HumanResources\Models\Employee whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Inspirium\HumanResources\Models\Employee whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Inspirium\HumanResources\Models\Employee whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Inspirium\HumanResources\Models\Employee whereMobilePre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Inspirium\HumanResources\Models\Employee whereMobileVpn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Inspirium\HumanResources\Models\Employee wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Inspirium\HumanResources\Models\Employee wherePhonePre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Inspirium\HumanResources\Models\Employee wherePhoneVpn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Inspirium\HumanResources\Models\Employee wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Inspirium\HumanResources\Models\Employee whereRoom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Inspirium\HumanResources\Models\Employee whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Inspirium\HumanResources\Models\Employee whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Inspirium\HumanResources\Models\Employee whereUserId($value)
 * @mixin \Eloquent
 * @property-read mixed $link
 * @property-read \Illuminate\Database\Eloquent\Collection|\Inspirium\Messaging\Models\Thread[] $threads
 */
class Employee extends Authenticatable {

	use Notifiable, HasApiTokens;

    protected $guarded = [ 'created_at', 'update_at', 'deleted_at' ];
    protected $appends = [ 'name', 'department_name' ];

	protected $hidden = [ 'password', 'remember_token', ];

    public function department() {
        return $this->belongsTo('Inspirium\HumanResources\Models\Department');
    }

	public function roles() {
		return $this->belongsToMany('Inspirium\HumanResources\Models\Role', 'users_roles');
	}

	public function threads() {
		return $this->belongsToMany('Inspirium\Messaging\Models\Thread', 'threads_employees', 'employee_id', 'thread_id');
	}

	public function hasRole($check) {
		return in_array($check, array_pluck($this->roles->toArray(), 'name'));
	}

    public function getDepartmentNameAttribute() {
        return $this->department->name;
    }

    public function getNameAttribute() {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getImageAttribute($value) {
    	if ($value) {
		    return Storage::disk('public')->url($value);
	    }
	    if ($this->email) {
		    return 'https://www.gravatar.com/avatar/' . md5( $this->email ) . '?s=50&d=mm';
	    }
	    if ($this->user->email) {
		    return 'https://www.gravatar.com/avatar/' . md5( $this->user->email ) . '?s=50&d=mm';
	    }
	    return 'https://mdbootstrap.com/img/Photos/Avatars/avatar-6.jpg';
    }

    public function getLinkAttribute() {
    	return '/human_resources/employee/show/'.$this->id;
    }

	public function receivesBroadcastNotificationsOn()
	{
		return 'users.'.$this->id;
	}
}
