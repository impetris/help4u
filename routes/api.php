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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Auth::routes(['verify' => true]);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('user', 'LoggedInUserController');

    Route::post('people/register', 'RegisterController');

    Route::get('person', 'PersonController@show');
    Route::put('people/{person}', 'PersonController@update')->middleware('can:update,person');

    Route::get('inquiries', 'InquiryController@index');
    Route::put('inquiries/{inquiry}', 'InquiryController@update')->middleware('can:update,inquiry');
});

Route::post('user', 'RegisterUserController@register');
Route::post('help-search', 'HelpSearchController');

Route::post('set-locale', 'SetLocaleController');
