<?php

namespace Inspirium\HumanResources\Controllers\Api;

use App\Http\Controllers\Controller;
use Inspirium\HumanResources\Models\Employee;

class EmployeeController extends Controller {

	public function searchEmployee($term) {
		$employees = Employee::where('first_name', 'LIKE', '%'.$term.'%')->orWhere('last_name', 'LIKE', '%'.$term.'%')->get();
		return response()->json($employees);
	}

	public function getEmployee($id) {
		$employee = Employee::findOrFail($id);
		return response()->json($employee);
	}
}