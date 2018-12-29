<?php

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
Route::group([
  'prefix' => 'auth',
  'namespace' => 'Auth'
], function () {
     Route::post('login', 'AuthController@login');
     Route::post('register' , 'AuthController@register');
});


Route::resource('galleries', GalleriesController::class)->except([
  'create', 'edit'
]);

Route::get('galleries/page', 'GalleriesController@index');

Route::middleware('auth:api')->get('authors-galleries/{id}', 'AuthorGalleriesController@index');
Route::middleware('auth:api')->get('my-galleries', 'MyGalleriesController@show');
Route::middleware('auth:api')->post('my-galleries/{id}', 'CommentsController@store');
Route::middleware('auth:api')->delete('/comment/{id}', 'CommentsController@destroy');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
