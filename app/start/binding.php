<?php

/*
|--------------------------------------------------------------------------
| IoC bindings
|--------------------------------------------------------------------------
|
*/

App::bind('ISorRepo', 'SorEloquentRepo');
App::bind('IProjectRepo', 'ProjectStreamRepo');
App::bind('IGpsRepo', 'GpsStreamRepo');
