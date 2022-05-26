<?php

//statisk endpoint som returnerar versioninfo.
$router->get('/', function () use ($router) {

    return $router->app->version();
});

//GET /test/
$router->get('test', function() {
  return ['works' => true];
});

//GET /movies/
$router->get('movies', 'MoviesController@index');
//GET /movies/{id}/
$router->get('movies/{id}', 'MoviesController@findMovie');
//GET /movies/{title}/
//$router->get('movie/{title}', 'MoviesController@findByTitle');
//POST /movies/
$router->post('movies', 'MoviesController@addMovie');
//PUT /movies/{id}/
$router->put('movies/{id}','MoviesController@changeMovie');
//DELETE /movies/{id}/
$router->delete('movies/{id}', 'MoviesController@deleteMovie');
