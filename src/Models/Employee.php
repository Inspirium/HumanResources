<?php

namespace Inspirium\HumanResources\Models;

use Illuminate\Database\Eloquent\Model;
use Phoenix\EloquentMeta\MetaTrait;

class Employee extends Model {

    use MetaTrait;

    protected $meta_model = 'Inspirium\HumanResources\Models\EmployeeModelMeta';

    protected $fillable = ['first_name', 'last_name', 'email', 'department_id'];
    protected $appends = ['name', 'phone', 'mobile', 'room', 'department_name'];

    public function department() {
        return $this->belongsTo('Inspirium\HumanResources\Models\Department');
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
}
