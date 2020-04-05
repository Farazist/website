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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return auth()->guard('api')->user();
});

// Mobile

Route::post('/signin-user', 'ApiController@signInUser');
Route::post('/change-user-password', 'ApiController@changeUserPassword');
Route::post('/check-user', 'ApiController@checkUser');
Route::post('/signup-user', 'ApiController@signUpUser');
Route::post('/get-categories', 'ApiController@getCategories');
Route::post('/get-items', 'ApiController@getItems');
Route::post('/verification-sms', 'ApiController@verificationSMS');
Route::post('/socket', 'WebSocketController@myMessage');

Route::post('/get-cities', 'ApiController@getCities');
Route::post('/get-province-cities', 'ApiController@getProvinceCities');
Route::post('/get-provinces', 'ApiController@getProvinces');

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('/send-qrcode', 'ApiController@sendQrcode');
    Route::post('/get-user', 'ApiController@getUser');
    Route::post('/edit-user', 'ApiController@editUser');
    Route::post('/get-target-user', 'ApiController@getTargetUser');
    Route::post('/get-user-deliveries', 'ApiController@getUserDeliveries');
    Route::post('/get-last-user-delivery', 'ApiController@getLastUserDelivery');
    Route::post('/get-user-transactions', 'ApiController@getUserTransactions');
    Route::post('/get-owner-citizens-count', 'ApiController@getOwnerCitizensCount');
    Route::post('/get-system-deliveries', 'ApiController@getSystemDeliveries');
    Route::post('/get-user-tickets', 'ApiController@getUserTickets');
    Route::post('/get-ticket-messages', 'ApiController@getTicketMessages');
    Route::post('/get-ticket-groups', 'ApiController@getTicketGroups');
    Route::post('/add-ticket', 'ApiController@addTicket');
    Route::post('/add-ticket-message', 'ApiController@addTicketMessage');
    Route::post('/transfer', 'ApiController@transfer');
    Route::post('/transfer-secure', 'ApiController@transferSecure');
    Route::post('/get-faqs', 'ApiController@getFaqs');
    Route::post('/get-informations', 'ApiController@getInformations');
    Route::post('/get-sliders', 'ApiController@getSliders');
    Route::post('/get-system-sliders', 'ApiController@getSystemSliders');
    Route::post('/get-systems', 'ApiController@getSystems');
    Route::post('/get-system', 'ApiController@getSystem');
    Route::post('/edit-system', 'ApiController@editSystem');
    Route::post('/add-new-delivery', 'ApiController@addNewDelivery');
    Route::post('/edit-delivery', 'ApiController@editDelivery');
    Route::post('/delete-delivery', 'ApiController@deleteDelivery');
});
