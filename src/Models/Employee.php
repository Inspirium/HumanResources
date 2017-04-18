<?php

namespace Inspirium\HumanResources\Models;

use Illuminate\Database\Eloquent\Model;
use Phoenix\EloquentMeta\MetaTrait;

class Employee extends Model {

    use MetaTrait;

    protected $meta_model = 'Inspirium\HumanResources\Models\EmployeeModelMeta';
}
