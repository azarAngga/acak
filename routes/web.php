<?php

use Illuminate\Support\Facades\Route;
use App\Events\WebsocketDemoEvent;

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
    // broadcast(new WebsocketDemoEvent('somedata'));
    return view('login');
});

Route::get('admin', function () {
    return view('admin_template');
});

Route::get('home', function () {
    return view('home');
});

Route::get('/logout','LoginController@logout');


Route::get('login', function () {
    return view('login');
});

Route::get('inbox/{id}','OrdersController@inbox' );

Route::get('register', 'LoginController@register');

Route::post('action_register', 'LoginController@actionRegister');

Route::get('tableOrder','OrdersController@index' );

// excel
Route::get('report/eksekutor','OrdersController@report' );
Route::get('report/eksekutor/{tanggal1}/{tanggal2}','OrdersController@reportWithDate' );
Route::get('export/eksekutor', 'OrdersController@export');
Route::get('export/eksekutor/{tanggal1}/{tanggal2}', 'OrdersController@exportWithDate');

// permintaan
Route::get('report/permintaan','OrdersController@report' );
Route::get('report/permintaan/{tanggal1}/{tanggal2}','OrdersController@reportWithDate' );
Route::get('export/permintaan', 'OrdersController@export');
Route::get('export/permintaan/{tanggal1}/{tanggal2}', 'OrdersController@exportWithDate');

// chart
Route::get('chart/report', 'OrdersController@chart');

Route::get('grafik/line/permintaan', 'OrdersController@line');
Route::get('grafik/line/permintaan/{tanggal1}/{tanggal2}', 'OrdersController@lineWithDate');

Route::get('grafik/line/eksekutor', 'OrdersController@line');
Route::get('grafik/line/eksekutor/{tanggal1}/{tanggal2}', 'OrdersController@lineWithDate');

Route::post('login', 'LoginController@actionLogin');

Route::get('user/table/{id}', 'LoginController@userTable');

Route::get('data','LoginController@checkLogin');
// Route::get('grafik/line',function(){

//     return view('grafik.line');
// });



// p21
Route::get('inputer','OrdersController@getInputer');

Route::get('inbox','OrdersController@getInputer' );


 // excel 
Route::get('report/{id}','OrdersController@report' );
Route::get('report/eksekutor/{tanggal1}/{tanggal2}','OrdersController@reportWithDate' );
Route::get('export/eksekutor', 'OrdersController@export');
Route::get('export/eksekutor/{tanggal1}/{tanggal2}', 'OrdersController@exportWithDate');


// table
Route::get('table/{id}','OrdersController@inboxOrder' );
Route::post('table/search','OrdersController@inboxOrderSearchPost' );

// table search
Route::post('table/search','OrdersController@inboxOrderSearch' );

//Route::get('mitra/table','OrdersController@TableMitra' );

// report 
Route::get('report/mitra/permintaan/{id}','OrdersController@reportMitra' );

