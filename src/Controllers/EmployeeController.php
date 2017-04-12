<?php

namespace Inspirium\HumanResources\Controllers;

use App\Http\Controllers\Controller;

class EmployeeController extends Controller {

    public function showEmployees() {
        return view(config('app.template').'::hr.list');
    }

    public function showEmployee() {
        return view(config('app.template').'::hr.single');
    }
}
