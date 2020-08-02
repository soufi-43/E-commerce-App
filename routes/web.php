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

use App\City;
use App\Country;
use App\Http\Controllers\DataImportController;
use App\Image;
use App\Product;
use App\State;
use App\User;

//Route::get('units-test','DataImportController@importUnits'  );
//Route::get('states', function () {
//    return State::with(['cities','country'])->paginate(5);
//});
//Route::get('users', function () {
//    return User::paginate(50);
//});
//
//Route::get('products', function () {
//    return Product::with(['images'])->paginate(100);
//});
//
//Route::get('images', function () {
//    return Image::with(['product'])->paginate(100);
//});





Route::get('test', function () {
    return 'hello';
})->middleware(['auth','email_verified']);

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
