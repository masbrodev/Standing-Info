<?php

use Illuminate\Support\Facades\Route;
use Brian2694\Toastr\Facades\Toastr;
use phpDocumentor\Reflection\Types\Resource_;

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
Route::get('/a', function () {
     Toastr::success('Messages in here', 'Title', ["positionClass" => "toast-top-center"]);
    return view('pages.produk');
});

Route::get('/', 'AgendaController@jadwal');
Route::get('/jadwal', 'HomeController@welcome');
Route::get('/home', function(){
    return redirect('gambar');
});

Auth::routes();

Route::get('/admin', 'AgendaController@adminjadwal');
Route::resource('agenda','AgendaController');
Route::resource('gambar','GambarController');
Route::resource('vidio','VidioController');
