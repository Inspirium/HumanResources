<?php

namespace Inspirium\HumanResources\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inspirium\HumanResources\Models\Department;
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

    public function showEditEmployee($id = null) {
        $employee = Employee::firstOrNew(['id' => $id]);
        $departments = Department::all();
        $phones = ['099', '098', '097', '095', '092', '091', '01',
            '020', '021', '022', '023',
            '030', '031', '032', '033', '034', '035',
            '040', '042', '043', '044', '047', '048', '049',
            '051', '052', '053',
            ];
        return view(config('app.template').'::hr.edit', ['employee' => $employee, 'departments' => $departments, 'phones' => $phones]);
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
