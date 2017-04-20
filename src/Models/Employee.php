<?php

namespace Inspirium\HumanResources\Models;

use Illuminate\Database\Eloquent\Model;
use Phoenix\EloquentMeta\MetaTrait;

class Employee extends Model {

    use MetaTrait;

    protected $meta_model = 'Inspirium\HumanResources\Models\EmployeeModelMeta';

    protected $fillable = ['first_name', 'last_name', 'email', 'department_id'];

    public function department() {
        return $this->belongsTo('Inspirium\HumanResources\Models\Department');
    }
}
