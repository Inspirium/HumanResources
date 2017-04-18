<?php

namespace Inspirium\HumanResources\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inspirium\HumanResources\Models\Employee;

class EmployeeController extends Controller {

    public function showEmployees() {
        $employees = Employee::all();
        return view(config('app.template').'::hr.list', ['employees'=> $employees]);
    }

    public function showEmployee($id) {
        $employee = Employee::find($id);
        return view(config('app.template').'::hr.show', ['employee'=>$employee]);
    }

    public function showEditEmployee($id) {
        if ($id) {
            $employee = Employee::find($id);
        }
        else {
            $employee = new Employee();
        }
        return view(config('app.template').'::hr.edit', ['employee' => $employee]);
    }

    public function submitEmployee(Request $request, $id = null) {
        $this->validate($request, []);

        if ($id) {
            $employee = Employee::find($id);
        }
        else {
            $employee = Employee::create([]);
        }
        return redirect('hr/employee/show/'.$employee->id);
    }
}
