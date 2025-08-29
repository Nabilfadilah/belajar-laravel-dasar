<?php

use App\Http\Controllers\InputController;
use Illuminate\Support\Facades\App;
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
//----------------------------------

// Nested View Directory
// view bisa disimpan dalam directory lagi dalam directory views
Route::get('/hello-world', function () {
    return view('hello.world', ['name' => 'fadilah']);
});

// route parameter
Route::get('/products/{id}', function ($productId) {
    return "Products : " . $productId;
});
// Route::get('/products/{product}/items/{item}', function ($productId, $itemId) {
//     return "Products : " . $productId . ", Items : " . $itemId;
// });

// regular expression constraint
Route::get('/categories/{id}', function (string $categoryId) {
    return "Categories : " .  $categoryId;
})->where('id', '[0-9]+');

// optional route parameter, id ? (tanda tanya)
Route::get('/users/{id?}', function (string $userId = '404') {
    return "Users : " . $userId;
});

// routing conflict
Route::get('/conflict/abil', function () {
    return "Conflict Nabil Fadilah";
});
Route::get('/conflict/{name}', function (string $name) {
    return "Conflict $name";
});

// named route
Route::get('/products/{id}', function ($productId) {
    return "Products : " . $productId;
})->name('product.detail');

Route::get('/products/{product}/items/{item}', function ($productId, $itemId) {
    return "Products : " . $productId . ", Items : " . $itemId;
})->name('product.item.detail');

Route::get('/categories/{id}', function (string $categoryId) {
    return "Categories : " . $categoryId;
})->where('id', '[0-9]')->name('category.detail');

Route::get('/users/{id?}', function (string $userId = '404') {
    return "Users : " . $userId;
})->name('user.detail');

// menggunakan named route
Route::get('/produk/{id}', function ($id) {
    $link = route('product.detail', [
        'id' => $id
    ]);
    return "Link : " . $link;
});

Route::get('/produk-redirect/{id}', function ($id) {
    return redirect()->route('product.detail', [
        'id' => $id
    ]);
});

// route controller
// request
Route::get('/controller/hello/request', [\App\Http\Controllers\HelloController::class, 'hello']);

// Route::get('controller/hello', [\App\Http\Controllers\HelloController::class, 'HelloController@hello']);
Route::get('controller/hello/{name}', [\App\Http\Controllers\HelloController::class, 'hello']);

// request input
Route::get('/input/hello', [\App\Http\Controllers\InputController::class, 'hello']);
// Route::post('/input/hello', [\App\Http\Controllers\InputController::class, 'hello']);
// Route::get('/input/hello', [InputController::class, 'hello']);
// Route::post('/input/hello', [InputController::class, 'hello']);


// nested input
Route::post('/input/hello/first', [\App\Http\Controllers\InputController::class, 'helloFirst']);

// file upload
Route::post('/file/upload', [\App\Http\Controllers\FileController::class, 'upload']); // 'upload' = method

// response
Route::get('/response/hello', [\App\Http\Controllers\ResponseController::class, 'response']);
// response header
Route::get('/response/header', [\App\Http\Controllers\ResponseController::class, 'header']);
// response type
Route::prefix("/response/type")->group(function () {
    Route::get('/view', [\App\Http\Controllers\ResponseController::class, 'responseView']);
    Route::get('/json', [\App\Http\Controllers\ResponseController::class, 'responseJson']);
    Route::get('/file', [\App\Http\Controllers\ResponseController::class, 'responseFile']);
    Route::get('/download', [\App\Http\Controllers\ResponseController::class, 'responseDownload']);
});
