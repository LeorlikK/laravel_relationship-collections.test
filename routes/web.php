<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Test\BlaController;
use App\Http\Controllers\Test\UserController;
use App\Http\Controllers\Test\CreateController;
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
})->name('welcome');

//Route::prefix('admin')->group(function () {
//    Route::get('/users', function () {
//        Route::get('/test', 'TestController')->name('get_test');
//    });
//});
//Route::name('Test')->group(function (){
//    Route::get('/test', \App\Http\Controllers\PageController::class, 'test')->name('get_test');
//});

//Route::get('/test', BlaController::class)->name('test');
////Route::get('/show', [UserController::class, 'show'])->name('test');
//Route::get('/index', function () {
//    return view('index');
//})->name('index');
//Route::get('/create', CreateController::class)->name('create');
Route::get('/test-ip', [BlaController::class, 'testIp'])->name('testIp');

Route::group(['namespace' => 'Test'], function (){
//    Route::get('/create', CreateController::class)->name('create');
    Route::get('/index', function () {
        return view('index');
        })->name('index');
    Route::get('/test', [BlaController::class, 'index'])->name('test');
    Route::get('/test/show/{post}', [BlaController::class, 'show'])->name('show');
    Route::post('/test/create', [BlaController::class, 'create'])->name('create');

    Route::get('/query', [BlaController::class, 'queryBuilder'])->name('query');
    Route::get('/collections', [BlaController::class, 'collections'])->name('collections');
    Route::get('/eloquent-collections', [BlaController::class, 'eloquentCollections'])->name('eloquent-collections');
    Route::get('/relationship', [BlaController::class, 'relationship'])->name('relationship');
});

//Route::()
Route::group(['prefix' => 'name'], function (){
    Route::get('/one', function (){return 'ONE';});
    Route::get('/two', function (){return 'TWO';});
});





