<?php

  namespace App\Http\Controllers;

  use App\Models\Movie;
  use Illuminate\Http\Request;
  use Illuminate\Validation\Rule;

  class MoviesController extends Controller {

  private $success = ['success' => true];

  public function index() {

    $movie = Movie::all()->sortBy('title', SORT_NATURAL|SORT_FLAG_CASE);

    return response()->json($movie);
  }

  public function findMovie($id) {

    $movie = Movie::find($id);

    if($movie == null) {

      return '404 Not Found.';
    } else {

      return response()->json($movie);
    }
  }

  public function addMovie(Request $request) {

    $movie = Movie::create($request->all());
    $movie->title = $request->input('title');
    $movie->year = $request->input('year');
    $movie->genre = $request->input('genre');
    $movie->rating = $request->input('rating');

    return response()->json($this->success);
  }

  public function changeMovie(Request $request, $id) {

    $movie = Movie::find($id);
    $movie->title = $request->input('title');
    $movie->year = $request->input('year');
    $movie->genre = $request->input('genre');
    $movie->rating = $request->input('rating');
    $movie->save();

    if($movie == null) {

      return '404 Not Found.';
    } else if($movie != null) {

      return response()->json($this->success);
    } else {
      //422 UNPROCESSABLE ENTITY
    }

  }

  public function deleteMovie($id) {

    $movie = Movie::find($id);
    if($movie == null) {

      return '404 Not Found.';
    } else {

      $movie->delete();
      return response()->json($this->success);
    }
  }

}
