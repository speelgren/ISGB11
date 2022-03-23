<?php

$router->get('/', function() use ($router) {

    return $router->app->version();
});

$router->get('test', function() use ($router) {

  $test = array("works" => true);
  return json_encode($test);
});

$router->group(['namespace'], function() use ($router) {

  $router->get('movies', 'MoviesController@index');
  $router->get('movies/{id}', 'MoviesController@findMovie');
  $router->post('movies', 'MoviesController@addMovie');
  $router->put('movies/{id}', 'MoviesController@changeMovie');
  $router->delete('movies/{id}', 'MoviesController@deleteMovie');
});
