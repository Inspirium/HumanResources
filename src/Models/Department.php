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
}

