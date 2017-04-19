<?php


use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Inspirium\HumanResources\Controllers', 'middleware' => 'web', 'prefix' => 'hr'], function() {
    Route::group(['prefix' => 'employees'], function () {
        Route::get('employees', 'EmployeeController@showEmployees');
        Route::get('employees/show/{id}', 'EmployeeController@showEmployee');
        Route::get('employees/edit/{id?}', 'EmployeeController@showEditEmployee');
        Route::post('employees/edit/{id?}', 'EmployeeController@submitEmployee');
        Route::get('employees/delete/{id}', 'EmployeeController@deleteEmployee');
    });
    Route::group(['prefix' => 'departments'], function() {
        Route::get('/', 'DepartmentController@showDepartments');
        Route::get('edit/{id?}', 'DepartmentController@showDepartment');
        Route::post('edit/{id?}', 'DepartmentController@submitDepartment');
        Route::get('delete/{id}', 'DepartmentController@deleteDepartment');
    });
});
