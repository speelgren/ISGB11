<?php

	namespace App\Http\Controllers;

	use App\Models\Movie;
	use Illuminate\Http\Request;
	use Illuminate\Validation\Rule;

	class MoviesController extends Controller {

    private $success = array("success" => true);

    public function index() {

      // för att sortera titel i bokstavsordning.
      // https://www.php.net/manual/en/array.constants.php
      $movie = Movie::all()->sortBy('title', SORT_NATURAL|SORT_FLAG_CASE);
      return response()->json($movie);
    }

    public function findMovie($id) {

      // find() returnerar null när $id inte hittas
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

      return response()->json($movie);
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
      } else if ($movie != null) {

        return json_encode($this->success);
      } else {

        //422 Unprocessable Entity
        return '422 Unprocessable Entity';
      }
    }

    public function deleteMovie($id) {

      $movie = Movie::find($id);

      if($movie == null) {

        return '404 Not Found.';
      } else {

        $movie->delete();
        return json_encode($this->success);
      }

    }

}
