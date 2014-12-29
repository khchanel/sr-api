<?php

/*
|--------------------------------------------------------------------------
| IoC bindings
|--------------------------------------------------------------------------
|
*/

App::bind('ISorRepo', 'SorEloquentRepo');
App::bind('IProjectRepo', 'ProjectRepo');
App::bind('IGpsRepo', 'GpsStreamRepo');
