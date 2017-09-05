<?php

namespace Inspirium\HumanResources\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inspirium\HumanResources\Models\Department;
use Inspirium\HumanResources\Models\Employee;

class EmployeeController extends Controller {

    public function showEmployees() {
        $elements = Employee::all();
        $columns = [
            'image' => [ 'title' => 'Image', 'breakpoint' => '', 'raw' => true ],
            'name' => [ 'title' => 'Name', 'breakpoint' => ''],
            'department_name' => [ 'title' => 'Department', 'breakpoint' => 'md'],
            'phone' => [ 'title' => 'Phone', 'breakpoint' => 'md' ],
            'mobile' => [ 'title' => 'Mobile', 'breakpoint' => 'md' ],
            'room' => [ 'title' => 'Room', 'breakpoint' => 'md' ]
        ];
        $strings = [
            'title' => 'Employees',
            'add_new' => 'Add New Employee',
        ];
        $links = [
            'add_new' => url('human_resources/employee/edit'),
            'edit' => url('human_resources/employee/edit/'),
            'delete' => url('human_resources/employee/delete/'),
            'show' => url('human_resources/employee/show/')
        ];
        return view(config('app.template') . '::vue.table-search', compact( 'elements', 'columns', 'strings', 'links' ));
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
                'department_id' => $request->input('department_id'),
	            'sex' => $request->input('sex'),
	            'mobile_pre' => $request->input('mobile_pre'),
	            'mobile' => $request->input('mobile'),
	            'mobile_vpn' => $request->input('mobile_vpn'),
	            'phone_pre' => $request->input('phone_pre'),
	            'phone' => $request->input('phone'),
	            'phone_vpn' => $request->input('phone_vpn'),
	            'address' => $request->input('address'),
	            'city' => $request->input('city'),
	            'postal_code' => $request->input('postal_code'),
	            'room' => $request->input('room')
            ]);
        $employee->save();
        return redirect('human_resources/employee/show/'.$employee->id);
    }
}
