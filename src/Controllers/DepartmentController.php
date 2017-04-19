<?php

namespace Inspirium\HumanResources\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inspirium\HumanResources\Models\Department;

class DepartmentController extends Controller {

    public function showDepartments() {
        $departments = Department::all();
        return view(config('app.template').'::hr.departments.list', ['departments' => $departments]);
    }

    public function showDepartment($id = null) {
        $department = Department::firstOrNew(['id' => $id]);
        return view(config('app.template').'::hr.departments.edit', ['department' => $department]);
    }

    public function submitDepartment(Request $request, $id = null) {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $department = Department::updateOrCreate(['id' => $id], ['name' => $request->input('name')]);

        return redirect('hr/deparments');
    }
}
