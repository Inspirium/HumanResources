<?php

namespace Inspirium\HumanResources\Models;

use Illuminate\Database\Eloquent\Model;
use Phoenix\EloquentMeta\MetaTrait;

class Employee extends Model {

    use MetaTrait;

    protected $meta_model = 'Inspirium\HumanResources\Models\EmployeeModelMeta';

    protected $fillable = ['first_name', 'last_name', 'email', 'department_id'];
    protected $appends = ['name', 'phone', 'mobile', 'room', 'department_name'];

    public function user() {
    	return $this->belongsTo('Inspirium\UserManagement\Models\User');
    }

    public function department() {
        return $this->belongsTo('Inspirium\HumanResources\Models\Department');
    }

    public function tasks() {
    	return $this->belongsToMany('Inspirium\TaskManagement\Models\Task', 'employee_task_pivot', 'employee_id', 'task_id');
    }

    public function getDepartmentNameAttribute() {
        return $this->department->name;
    }

    public function getNameAttribute() {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getPhoneAttribute() {
        return $this->getMeta('phone_pre') . ' ' .$this->getMeta('phone');
    }

    public function getMobileAttribute() {
        return $this->getMeta('mobile_pre') . ' ' .$this->getMeta('mobile');
    }

    public function getRoomAttribute() {
        return $this->getMeta('room');
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
}
