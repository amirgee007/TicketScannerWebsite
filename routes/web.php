<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

/*Route::get('/', function () {
    return view('base');
});

Route::get('/index', function () {
    return view('base');
});

Route::get('/test', function () {
    return view('homepage');
});*/

Route::get('/', 'PagesController@base');
//Route::get('/index', 'PagesController@base');
Route::get('/loginOld', 'PagesController@login');
Route::get('/registerOld', 'PagesController@register');
Route::get('/about', 'PagesController@about');


// Event manipulation section
Route::get('/event', 'AppController@event');
Route::get('/event/add', 'AppController@eventAdd');
Route::get('/event/edit', 'AppController@eventEdit');
Route::post('/event/add', 'AppController@Add');
Route::get('/event/list/{id}', 'AppController@eventList');
Route::get('/app', 'AppController@appLaunch');

Auth::routes();

Route::get('/home', 'HomeController@index');


//api routes
Route::get('/api', 'ApiController@api');
Route::post('/api/createToken', 'ApiController@createToken');
Route::post('/api/event', 'ApiController@getEvents');
Route::post('/api/event/{id}', 'ApiController@getSingleEvent');
Route::post('/api/code/{id}', 'ApiController@getCode');
