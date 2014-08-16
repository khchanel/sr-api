<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::group(array('prefix' => 'api/v1', 'after' => 'cors.all'), function () {

    // default route to info
    Route::get('/', function() {
        $info = array(
            'name' => 'sr-api',
            'version' => '1.0'
            );

        return $info;
    });

    // API
    Route::resource('/sor', 'SorsController', array('only' => array('index', 'show')));
    Route::resource('/project', 'ProjectController', array('only' => array('index', 'show')));

    // API for legacy compatibility with Stream
    Route::get('/projects/services/projects.svc/GetProjectsMethod/inputStr/{user}/{passwd}', 'ProjectController@getAllProjects');
});
