<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model {

  protected $table = 'movies';
  protected $fillable = ['id', 'title', 'year', 'genre', 'rating', 'created_at', 'updated_at'];

}
