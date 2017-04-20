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
        $employee->getAllMeta();
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
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'department_id' => 'required'
        ]);

        $employee = Employee::updateOrCreate(['id' => $id],
            [
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'department_id' => $request->input('department_id')
            ]);
        $employee->save();
        $keys = [
            'sex', 'mobile_pre', 'mobile', 'mobile_vpn', 'phone_pre', 'phone', 'phone_vpn',
            'address', 'city', 'postal_code'
        ];
        foreach ($keys as $key) {
            $employee->updateMeta( $key, $request->input( $key ) );
        }
        return redirect('hr/employee/show/'.$employee->id);
    }
}
