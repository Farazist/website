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

Auth::routes();

Route::get('/chat', 'ChatsController@index');
Route::get('messages', 'ChatsController@fetchMessages');
Route::post('messages', 'ChatsController@sendMessage');

// Site Map
Route::get('/sitemap.xml', 'SitemapController@index');
Route::get('/sitemap.xml/topics', 'SitemapController@topics');

// User Auth
Route::get('/auth/google', 'UserController@redirectToGoogle');
Route::get('/auth/google/callback', 'UserController@handleGoogleCallback');

Route::get('/logout', 'HomeController@logout');

Route::get('/', 'HomeController@index');
Route::get('/about-us', 'HomeController@aboutUs');
Route::get('/faq', 'FaqController@getAllForClient');

Route::post('/send-message', 'MessageController@AddPost');

// Blog
Route::group(['prefix' => '/blog',], function () {
    Route::get('/', 'TopicController@getAllForClient');
    Route::get('/{category}', 'TopicController@ByCategoryGet');
    Route::get('/{category}/{id}', 'TopicController@SingleGet');
});

Route::get('/sign-up', 'UserController@SignUpGet');
Route::post('/sign-up', 'UserController@SignUpPost');
Route::post('/signin', 'UserController@SignIn');
Route::post('/search', 'SearchController@search');

Route::get('/user/category_posts/{category_name}', 'UserController@category_posts');

Route::group(['prefix' => '/user', 'middleware' => 'student'], function () {
    Route::get('/profile', 'UserController@Profile');

    Route::get('/courses', 'UserController@Courses');
    Route::get('/course/{course_id}/add-to-basket', 'UserController@AddToBasket');
    
    Route::get('/exams', 'UserController@Exams');
    Route::get('/account', 'UserController@get_account');
    Route::post('/account_edited', 'UserController@account_edited');

});

Route::get('/admin/login', 'AdminController@getLogin');
Route::post('/admin/login', 'AdminController@login');

Route::group(['prefix' => '/admin', 'middleware' => 'admin'], function () {

    Route::get('/', 'AdminController@Index');
    Route::get('/addAdmin', 'AdminController@getAddAdmin');
    Route::post('/addAdmin', 'AdminController@addAdmin');

    Route::post('/get-report-transactions-group-by-month', 'AdminController@getReportTransactionsGroupByMonth');
    Route::post('/get-report-deliveries-group-by-month', 'AdminController@getReportDeliveriesGroupByMonth');
    Route::post('/get-report-users-group-by-month', 'AdminController@getReportUsersGroupByMonth');

    // Topic
    Route::group(['prefix' => '/blog',], function () {
        Route::get('/add', 'TopicController@AddGet');
        Route::post('/add', 'TopicController@AddPost');
        Route::get('/edit/{id}', 'TopicController@EditGet');
        Route::post('/edit', 'TopicController@EditPost');
        Route::get('/delete/{id}', 'TopicController@DeleteGet');
        Route::get('/', 'TopicController@getAllForAdmin');
    });

    // Citizen
    Route::group(['prefix' => '/citizens',], function () {
        Route::get('/add', 'CitizenController@AddGet');
        Route::post('/add', 'CitizenController@AddPost');
        Route::get('/edit/{id}', 'CitizenController@EditGet');
        Route::post('/edit', 'CitizenController@EditPost');
        Route::get('/delete/{id}', 'CitizenController@DeleteGet');
        Route::get('/{id}/transactions', 'CitizenController@getCitizenTransactions');
        Route::get('/{id}/deliveries', 'CitizenController@getCitizenDeliveries');
        Route::get('/{citizen_id}/deliveries/{delivery_id}', 'CitizenController@getCitizenDeliveryItems');
        Route::get('/{id}', 'CitizenController@SingleGet');
        Route::get('/', 'CitizenController@getAllForAdmin');
    });

    // System
    Route::group(['prefix' => '/systems',], function () {
        Route::get('/add', 'SystemController@AddGet');
        Route::post('/add', 'SystemController@AddPost');
        Route::get('/edit/{id}', 'SystemController@EditGet');
        Route::post('/edit', 'SystemController@EditPost');
        Route::get('/delete/{id}', 'SystemController@DeleteGet');
        Route::get('/', 'SystemController@getAllForAdmin');
    });

    // FAQ
    Route::group(['prefix' => '/faqs',], function () {
        Route::get('/add', 'FaqController@AddGet');
        Route::post('/add', 'FaqController@AddPost');
        Route::get('/edit/{id}', 'FaqController@EditGet');
        Route::post('/edit', 'FaqController@EditPost');
        Route::get('/delete/{id}', 'FaqController@DeleteGet');
        Route::get('/', 'FaqController@getAllForAdmin');
    });

    // About
    Route::group(['prefix' => '/abouts',], function () {
        Route::get('/add', 'AboutController@AddGet');
        Route::post('/add', 'AboutController@AddPost');
        Route::get('/edit/{id}', 'AboutController@EditGet');
        Route::post('/edit', 'AboutController@EditPost');
        Route::get('/delete/{id}', 'AboutController@DeleteGet');
        Route::get('/', 'AboutController@getAllForAdmin');
    });

    // Counter
    Route::group(['prefix' => '/counters',], function () {
        Route::get('/add', 'CounterController@AddGet');
        Route::post('/add', 'CounterController@AddPost');
        Route::get('/edit/{id}', 'CounterController@EditGet');
        Route::post('/edit', 'CounterController@EditPost');
        Route::get('/delete/{id}', 'CounterController@DeleteGet');
        Route::get('/', 'CounterController@getAllForAdmin');
    });
    
    // Service
    Route::group(['prefix' => '/services',], function () {
        Route::get('/add', 'ServiceController@AddGet');
        Route::post('/add', 'ServiceController@AddPost');
        Route::get('/edit/{id}', 'ServiceController@EditGet');
        Route::post('/edit', 'ServiceController@EditPost');
        Route::get('/delete/{id}', 'ServiceController@DeleteGet');
        Route::get('/', 'ServiceController@getAllForAdmin');
    });

    // Employee
    Route::group(['prefix' => '/employees',], function () {
        Route::get('/add', 'EmployeeController@AddGet');
        Route::post('/add', 'EmployeeController@AddPost');
        Route::get('/edit/{id}', 'EmployeeController@EditGet');
        Route::post('/edit', 'EmployeeController@EditPost');
        Route::get('/delete/{id}', 'EmployeeController@DeleteGet');
        Route::get('/', 'EmployeeController@getAllForAdmin');
    });

    // Image
    Route::group(['prefix' => '/images',], function () {
        Route::get('/add', 'ImageController@AddGet');
        Route::post('/add', 'ImageController@AddPost');
        Route::get('/edit/{id}', 'ImageController@EditGet');
        Route::post('/edit', 'ImageController@EditPost');
        Route::get('/delete/{id}', 'ImageController@DeleteGet');
        Route::get('/', 'ImageController@getAllForAdmin');
    });

    // Partner
    Route::group(['prefix' => '/partners',], function () {
        Route::get('/add', 'PartnerController@AddGet');
        Route::post('/add', 'PartnerController@AddPost');
        Route::get('/edit/{id}', 'PartnerController@EditGet');
        Route::post('/edit', 'PartnerController@EditPost');
        Route::get('/delete/{id}', 'PartnerController@DeleteGet');
        Route::get('/', 'PartnerController@getAllForAdmin');
    });

    Route::get('/signout', 'AdminController@SignOut');

});