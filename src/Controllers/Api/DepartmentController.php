<?php

namespace Inspirium\HumanResources\Controllers\Api;

use App\Http\Controllers\Controller;
use Inspirium\HumanResources\Models\Department;

class DepartmentController extends Controller {

	public function searchDepartment($term) {
		$departments = Department::where('name', 'LIKE', '%'.$term.'%')->get();
		return response()->json($departments);
	}

	public function getDepartment($id) {
		$department = Department::findOrFail($id);
		return response()->json($department);
	}
}