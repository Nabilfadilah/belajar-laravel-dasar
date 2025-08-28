<?php

use Illuminate\Support\Facades\Route;

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

// Basic route
// Route::'method'($url, $callback);
Route::get('/pzn', function () {
    return "Hello Nabil Fadilah";
});

// Redirect, ke satu halaman ke halaman lain
// Route::redirect(from, to)
Route::redirect('/youtube', '/pzn');

// Fallback Route, yaitu callback yg akan dieksekusi ketika
// tidak ada route yg cocok dengan halaman yg diakses
// Route::fallback(closure);
Route::redirect('/youtube', '/pzn');
Route::fallback(function () {
    return "404";
});
//-------------------------------------------------

// rendering view
// Route::view(url, template, array)
// Route::get('/hello', function () {
//     return view('hello');
// });

// kita bisa tambah blade variabel untuk nama
// view(template, array)
Route::view('/hello', 'hello', ['name' => 'GOBILL']);

// Route::view(url, template, array)
Route::get('/hello-again', function () {
    return view('hello', ['name' => 'GOBILL']);
});
