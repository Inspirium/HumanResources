<?php


use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Inspirium\HumanResources\Controllers', 'middleware' => ['web', 'auth'], 'prefix' => 'hr'], function() {
    Route::group(['prefix' => 'employee'], function () {
        Route::get('/', 'EmployeeController@showEmployees');
        Route::get('show/{id}', 'EmployeeController@showEmployee');
        Route::get('edit/{id?}', 'EmployeeController@showEditEmployee');
        Route::post('edit/{id?}', 'EmployeeController@submitEmployee');
        Route::get('delete/{id}', 'EmployeeController@deleteEmployee');
    });
    Route::group(['prefix' => 'department'], function() {
        Route::get('/', 'DepartmentController@showDepartments');
        Route::get('edit/{id?}', 'DepartmentController@showDepartment');
        Route::post('edit/{id?}', 'DepartmentController@submitDepartment');
        Route::get('delete/{id}', 'DepartmentController@deleteDepartment');
    });
});
