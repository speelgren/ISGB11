<?php namespace App\Http\Controllers;

	use App\Models\Movie;
	use Illuminate\Http\Request;
	use Illuminate\Validation\Rule;

	class MoviesController extends Controller {

    private $success = ['success' => true];

  //GET /movies/
  public function index() {

    $movie = Movie::all()->sortBy('title', SORT_NATURAL|SORT_FLAG_CASE);
    return $movie;
  }

  //GET /movies/{id}/
  public function findMovie($id) {

    $movie = Movie::findOrFail($id);
    return $movie;
  }

  //GET /movies/{title}/
  public function findByTitle($title) {

    $movie = Movie::where('title', '=', $title)->firstOrFail();
    return $movie;
  }

  //POST /movies/
  public function addMovie(Request $request) {

    $data = $this->validate($request, [
      'title' => 'required',
      'year' => 'integer',
      'genre' => 'string|alpha',
      'rating' => 'integer'
    ]);

    $movie = Movie::create($request->all());
    return $this->success;
  }

  //PUT /movies/{id}/
  public function changeMovie(Request $request, $id) {

    $movie = Movie::findOrFail($id);
    $data = $this->validate($request, [
      'title' => 'string',
      'year' => 'integer',
      'genre' => 'string|alpha',
      'rating' => 'integer'
    ]);

    $movie->fill($data);
    $movie->save();
    return $this->success;
  }

  //DELETE /movies/{id}/
  public function deleteMovie($id) {

    $movie = Movie::findOrFail($id);
    $movie->delete();
    return $this->success;
  }
}
