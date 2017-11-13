<?php

namespace Inspirium\HumanResources\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

	public function saveEmployee(Request $request, $id) {
		$employee = Employee::find($id);
		$input = $request->all();
		if ($request->hasFile('new_image') && $request->file('new_image')) {
			$file = $request->file('new_image');
			if(!$file->isValid()) {
				return response()->json([ 'result' => 'error', 'message' => 'Invalid file upload'], 400);
			}
			$path = $file->store(sprintf('%s/%d/%d', 'avatars', date('Y'), date('m') ), 'public');
			$input['image'] = $path;
		}

		$employee->update([
			'first_name' => $input['first_name'],
			'last_name' => $input['last_name'],
			'email' => $input['email'],
			'mobile_pre' => $input['mobile_pre'],
			'mobile' => $input['mobile'],
			'mobile_vpn' => $input['mobile_vpn'],
			'phone_pre' => $input['phone_pre'],
			'phone' => $input['phone'],
			'phone_vpn' => $input['phone_vpn'],
			'address' => $input['address'],
			'city' => $input['city'],
			'postal_code' => $input['postal_code'],
			'room' => $input['room'],
			'sex' => $input['sex'],
			'image' => $input['image'],
		]);
		return response()->json([]);
	}
}