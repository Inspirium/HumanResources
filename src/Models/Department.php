<?php
namespace Inspirium\HumanResources\Models;

use Illuminate\Database\Eloquent\Model;
use Phoenix\EloquentMeta\MetaTrait;

class Department extends Model {

    use MetaTrait;

    protected $meta_model = 'Inspirium\HumanResources\Models\DepartmentsModelMeta';

    protected $fillable = ['name'];

    public function employees() {
        return $this->hasMany('Inspirium\HumanResources\Models\Employee');
    }

	public function tasks() {
		return $this->belongsToMany('Inspirium\TaskManagement\Models\Task', 'department_task_pivot', 'department_id', 'task_id')->with('assigner')->withPivot('order')->orderBy('pivot_order');
	}
}

