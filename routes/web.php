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

//Route::get('/', function () {
//    return view('welcome');
//});

/**
 * Service Container - Zero Configuration Resolution
 * Class Service
 */
class Service
{}

Route::get('/', function (Service $service) {
    die(get_class($service));
});

/**
 * Service container - simple and singleton binding
 */
Route::get('/foo', function (\App\Services\Foo $foo) {
    return $foo->hello();
});

/**
 * Service container - binding interface to implementation
 */
//use anonymous function
//Route::get('/push', function (\App\Services\EventPusher $eventPusher) {
//    return $eventPusher->push();
//});
//or using call to the controller
Route::get('/push', [\App\Services\Pusher::class, 'index']);

