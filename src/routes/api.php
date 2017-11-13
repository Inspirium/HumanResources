<?php


Route::group(['prefix' => 'api/human_resources', 'middleware' => ['api', 'auth:api'], 'namespace' => 'Inspirium\HumanResources\Controllers\Api'], function() {
	Route::get('employee/{id}', 'EmployeeController@getEmployee');
	Route::post('employee/{id}', 'EmployeeController@saveEmployee');
	Route::get('employee/search/{term}', 'EmployeeController@searchEmployee');

	Route::get('department/{id}', 'DepartmentController@getDepartment');
	Route::get('department/search/{term}', 'DepartmentController@searchDepartment');
});