<?php

namespace Inspirium\HumanResources\Models;

use Illuminate\Database\Eloquent\Model;

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
class Employee extends Model {

    protected $fillable = ['first_name', 'last_name', 'email', 'department_id', 'link'];
    protected $appends = ['name', 'department_name'];

    public function user() {
    	return $this->belongsTo('Inspirium\UserManagement\Models\User');
    }

    public function department() {
        return $this->belongsTo('Inspirium\HumanResources\Models\Department');
    }

    public function tasks() {
    	return $this->belongsToMany('Inspirium\TaskManagement\Models\Task', 'employee_task_pivot', 'employee_id', 'task_id')->with('assigner')->withPivot('order')->orderBy('pivot_order');
    }

    public function getDepartmentNameAttribute() {
        return $this->department->name;
    }

    public function getNameAttribute() {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getImageAttribute($value) {
    	if ($value) {
    		return $value;
	    }
	    if ($this->email) {
		    return 'https://www.gravatar.com/avatar/' . md5( $this->email ) . '?s=50&d=wavatar"';
	    }
    	/*if ($this->user_id) {
		    return 'https://www.gravatar.com/avatar/' . md5( $this->user()->email ) . '?s=50&d=wavatar"';
	    }*/
	    return 'https://mdbootstrap.com/img/Photos/Avatars/avatar-6.jpg';
    }

    public function getLinkAttribute() {
    	return '/human_resources/employee/show/'.$this->id;
    }

	public function threads() {
		return $this->belongsToMany('Inspirium\Messaging\Models\Thread', 'threads_employees');
	}
}
