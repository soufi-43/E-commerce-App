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
use App\Role;
use App\State;
use App\Tag;
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

//Route::get('role-test', function () {
//    $role = Role::find(2);
//    return $role->users;
//});


//Route::get('test-email', function () {
//    return 'hello';
//})->middleware(['auth','user_is_admin','user_is_support']);

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['auth','user_is_admin'], function(){

    //units

    Route::get('units','UnitController@index')->name('units');

    Route::post('units','UnitController@store');
    Route::delete('units','UnitController@delete');



    //categories
    Route::get('categories','CategoryController@index')->name('categories');

    //products
    Route::get('products','ProductController@index')->name('products');

    //tags
    Route::get('tags','TagController@index')->name('tags');

    //countries
    Route::get('countries','CountryController@index')->name('countries');


    //cities
    Route::get('cities','CityController@index')->name('cities');

    //states
    Route::get('states','StateController@index')->name('states');


    //reviews
    Route::get('reviews','ReviewController@index')->name('reviews');


    //tickets
    Route::get('tickets','TicketController@index')->name('tickets');

    //roles
    Route::get('roles','RoleController@index')->name('roles');



}

);
