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

Route::get('/', function () {
  return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('counts/close', 'CountController@close');

Route::get('counts/byDateRange/{sd}/{ed}/{room_id}', 'CountController@byDateRange');
Route::get('operations/byDateRange/{sd}/{ed}/{room_id}', 'OperationController@byDateRange');
Route::get('operations/byDateRangeAndPosition/{sd}/{ed}/{position}/{operation}/{room_id}', 'OperationController@byDateRangeAndPosition');

Route::get('print/liquidacion/{sd}/{ed}/{room_id}', 'PrintController@liquidacion');
Route::get('print/relleno/{sd}/{ed}/{position}/{room_id}', 'PrintController@relleno');
Route::get('print/retiro/{sd}/{ed}/{position}/{room_id}', 'PrintController@retiro');
Route::get('print/pago/{sd}/{ed}/{position}/{room_id}', 'PrintController@pago');
Route::get('print/sala/{sd}/{ed}/{room_id}', 'PrintController@sala');

Route::post('machines/updateReg', 'MachineController@updateReg');
Route::get('machines/withoutRoom', 'MachineController@withoutRoom');

Route::get('rooms/{room_id}/withMachines', 'RoomController@withMachines');
Route::get('rooms/allWithMachines', 'RoomController@allWithMachines');

Route::apiResources([
  'machines' => 'MachineController',
  'operations' => 'OperationController',
  'counts' => 'CountController',
  'users' => 'UserController',
  'rooms' => 'RoomController',
  'games' => 'GameController',
  'factories' => 'FactoryController',
]);

Route::get('machines/changeState/{position}/{state}', 'MachineController@changeState');

Route::get('{any}', function () {
  return view('home');
})->where('any','.*');
