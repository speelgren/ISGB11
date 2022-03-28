<?php

$router->get('/', function() use ($router) {

    return $router->app->version();
});

$router->get('test', function() use ($router) {

  $test = array("works" => true);
  return json_encode($test);
});

  //GET /movies/
  $router->get('movies', 'MoviesController@index');
  //GET /movies/id
  $router->get('movies/{id}', 'MoviesController@findMovie');
  //GET Pierres föreläsning.
  //$router->get('movies/{title}', 'MoviesController@getByTitle');
  //POST /movies/
  $router->post('movies/', 'MoviesController@addMovie');
  //PUT /movies/id
  $router->put('movies/{id}', 'MoviesController@changeMovie');
  //DELETE /movies/id
  $router->delete('movies/{id}', 'MoviesController@deleteMovie');

/*

  validering



*/
