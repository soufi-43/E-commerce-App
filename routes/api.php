<?php

use App\Http\Resources\UserFullResource;
use App\Product;
use App\User;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('categories', 'Api\CategoryController@index');
Route::get('categories/{id}', 'Api\CategoryController@show');
Route::get('categories/{id}/products', 'Api\CategoryController@products');




Route::get('products', 'Api\ProductController@index');
Route::get('products/{id}', 'Api\ProductController@show');



Route::get('tags', 'Api\TagController@index');
Route::get('tags/{id}', 'Api\TagController@show');


Route::get('countries','Api\CountryController@index');
Route::get('countries/{id}/states','Api\CountryController@showStates');//show cities under countries
Route::get('countries/{id}/cities','Api\CountryController@showCities');//show cities under countries


Route::post('auth/register','Api\AuthController@register');
Route::post('auth/login','Api\AuthController@login');






Route::get('users',function (){
   return UserFullResource::collection(User::paginate());
});


Route::middleware('auth:api')->group( function () {
    Route::post('carts','Api\CartController@addProductToCart');
    Route::post('carts/{id}/remove','Api\CartController@removeProductFromCart');

    Route::get('carts','Api\CartController@index');

});
