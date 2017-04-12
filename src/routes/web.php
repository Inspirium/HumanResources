<?php


use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Inspirium\HumanResources\Controllers', 'middleware' => 'web'], function() {
    Route::get('hr/employees', 'EmployeeController@showEmployees');
});
