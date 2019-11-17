<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Empleado;
use App\Cargo;
use App\Rol;
use Illuminate\Support\Facades\Hash;

Route::get('/checkRoles', 'EmpleadoController@checkRole')->name('checkRole');
Route::get('/', 'EmpleadoController@index')->name('main');
Route::resource('empleados', 'EmpleadoController');
Route::resource('empleados.familiares', 'FamiliarController');


Route::get('reports', 'ReportsController@jobs')->name('reports.jobs');
Route::post('reports', 'ReportsController@selectJobs')->name('reports.selectJobs');

Route::get('civilstates', 'ReportsController@civilStatus')->name('reports.civilStatus');

Route::get('child', 'ReportsController@child')->name('reports.child');
Route::post('child', 'ReportsController@selectChild')->name('reports.selectChild');

Route::get('age', 'ReportsController@age')->name('reports.age');

Route::get('gender', 'ReportsController@gender')->name('reports.gender');

Route::get('hours', 'ReportsController@hours')->name('reports.hours');
Route::post('user.inactive', 'UserController@inactive')->name('user.inactive');

Route::resource('user', 'UserController');
Route::resource('user.referencia', 'ReferenciaController');
Route::get('myregister', function () {
    $cargos = Cargo::all();
    $roles = Rol::all();
    $empleado = Empleado::all();
    return view('login.register', compact('roles'), compact('cargos'));
})->name('myregister');

Route::get('assistance', 'UserController@assistance')->name('assistance');
Route::post('check', 'UserController@check')->name('check');

Route::post('compareUser', 'UserController@compare')->name('compare');
//Route::get('reset',function (){
//    $employees = Empleado::all();
//    foreach ($employees as $employee)
//    {
//        $employee -> password = Hash::make($employee -> password);
//        $employee -> save();
//    }
//});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');