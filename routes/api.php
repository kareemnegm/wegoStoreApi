<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::group(['prefix'=>'user'],function (){
    Route::post('signup','User\AuthController@signup');
    Route::post('login','User\AuthController@login');
});

Route::group(['prefix'=>'category'],function (){
    Route::get('categories','Category\CategoryController@getCategory');


});
Route::group(['prefix'=>'customer','middleware'=>'assign.guard:api'],function (){
    Route::post('/order','Order\OrderController@createOrder');


});

Route::group(['prefix'=>'storeOwner','middleware'=>'assign.guard:api'],function (){
Route::post('/category','Category\CategoryController@create');
Route::put('/category/{id}','Category\CategoryController@update');
Route::delete('/category/{id}','Category\CategoryController@destroy');
Route::post('/subcategory','Category\CategoryController@createSubcategory');

});


Route::group(['prefix'=>'store'],function (){
    Route::get('/','Store\StoreController@getStores');
    Route::get('/products/{id}','Store\StoreController@getStoreProductsForCustomers');
    Route::get('/{id}','Store\StoreController@getstore');
    Route::delete('/{id}','Store\StoreController@destroy');

});



Route::group(['prefix'=>'plan'],function (){
    Route::post('create','Admin\AdminController@createPlan')->middleware('assign.guard:Admin');
    Route::get('/','Admin\AdminController@showPlans');
    Route::get('/{id}','Admin\AdminController@showPlans');


});


Route::group(['prefix'=>'admin','middleware'=>'assign.guard:Admin'],function (){
   Route::post('signup','Admin\AdminController@signupAdmin')->withoutMiddleware('assign.guard:Admin');
   Route::post('login','Admin\AdminController@login')->withoutMiddleware('assign.guard:Admin');

});


Route::group(['prefix'=>'product'],function (){
Route::post('/','Product\ProductController@createProduct')->middleware('assign.guard:api');
Route::post('/addAttribute/{id}','Product\ProductController@addAttributeToProduct')->middleware('assign.guard:api');
Route::delete('/{id}','Product\ProductController@destroy')->middleware('assign.guard:api');
Route::get('/{id}','Product\ProductController@show');



});


Route::group(['prefix'=>'storeOwner'],function (){
Route::get('/store/prodcuts','storeOwner/storeOwnerController@getStoreProducts')->middleware('assign.guard:api');




});




Route::group(['prefix'=>'country'],function (){
    Route::post('/','Country\CountryController@storeCountry');
    Route::post('/city','Country\CountryController@storeCity');

    Route::get('/','Country\CountryController@countries');
    Route::get('/cities','Country\CountryController@countries_cities');
    Route::get('/city/{id}','Country\CountryController@cityFromCountry');//pass country id to retrieve cities

});
