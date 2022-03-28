<?php

	namespace App\Http\Controllers;

	use App\Models\Movie;
	use Illuminate\Http\Request;
	use Illuminate\Validation\Rule;

	class MoviesController extends Controller {

    private $success = ['success' => true];

    public function index() {

      // för att sortera titel i bokstavsordning.
      // https://www.php.net/manual/en/array.constants.php
      $movie = Movie::all()->sortBy('title', SORT_NATURAL|SORT_FLAG_CASE);
      return $movie;
    }

    public function findMovie($id) {

      // find() returnerar null när $id inte hittas
      $movie = Movie::findOrFail($id);
      return $movie;
    }

		//från pierres föreläsning.
		public function getByTitle($title) {

			$movie = Movie::where('title', '=', $title)->firstOrFail();
			return $movie;
		}

    public function addMovie(Request $request) {
			//422

			$data = $this->validate($request, [
				'title' => 'required',
				'year' => 'integer|alpha',
				'genre' => 'string|alpha',
				'rating' => 'integer|alpha'
			]);

			if(!$data->passes()) {
				return '422';
			}
      $movie = Movie::create($request->all());

    }

    public function changeMovie(Request $request, $id) {
			//422

      $movie = Movie::findOrFail($id);

			$data = $this->validate($request, [
				'title' => 'filled',
				'year' => 'filled|integer',
				'genre' => 'filled|string',
				'rating' => 'filled|integer'
			]);

			$movie->fill($data);
      $movie->save();

			return $this->success;
    }

    public function deleteMovie($id) {

      $movie = Movie::findOrFail($id);

			$movie->delete();
			return $this->success;
    }

}
