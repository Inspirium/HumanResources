<?php


use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Inspirium\HumanResources\Controllers', 'middleware' => ['web', 'auth'], 'prefix' => 'human_resources'], function() {
    Route::get('employees', 'EmployeeController@showEmployees');
    Route::group(['prefix' => 'employee'], function () {
        Route::get('edit/{id?}', 'EmployeeController@showEditEmployee');
        Route::post('edit/{id?}', 'EmployeeController@submitEmployee');
        Route::get('delete/{id}', 'EmployeeController@deleteEmployee');
        Route::get('show/{id}', 'EmployeeController@showEmployee');//TODO: remove show
    });
    Route::get('departments', 'DepartmentController@showDepartments');
    Route::group(['prefix' => 'departments'], function() {
        Route::get('edit/{id?}', 'DepartmentController@showDepartment');
        Route::post('edit/{id?}', 'DepartmentController@submitDepartment');
        Route::get('delete/{id}', 'DepartmentController@deleteDepartment');
    });
});
