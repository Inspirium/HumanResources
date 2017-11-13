<?php


use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Inspirium\HumanResources\Controllers', 'middleware' => ['web', 'auth'], 'prefix' => 'human_resources'], function() {
    Route::get('employees', 'EmployeeController@showEmployees');
    Route::group(['prefix' => 'employee'], function () {
      //  Route::get('edit/{id?}', 'EmployeeController@showEditEmployee');
      //  Route::post('edit/{id?}', 'EmployeeController@submitEmployee');
      //  Route::get('delete/{id}', 'EmployeeController@deleteEmployee');
        Route::get('{id}/show', 'EmployeeController@showEmployee');//TODO: remove show
	 /*   Route::any('{id}/{all}/{step}', function() {
		    return view(config('app.template') . '::router-view');
	    });*/
	    Route::any('{id}/{all}', function() {
		    return view(config('app.template') . '::router-view');
	    });
	  /*  Route::any('{all}', function() {
		    return view(config('app.template') . '::router-view');
	    });*/
    });
    Route::get('departments', 'DepartmentController@showDepartments');
    Route::group(['prefix' => 'departments'], function() {
        Route::get('edit/{id?}', 'DepartmentController@showDepartment');
        Route::post('edit/{id?}', 'DepartmentController@submitDepartment');
        Route::get('delete/{id}', 'DepartmentController@deleteDepartment');
    });
});
