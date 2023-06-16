<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $table = 'movies';
    protected $guarded = [];

    public function author()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function genre()
    {
        return $this->belongsTo('App\Models\Genre');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genres_movies');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'movies_tags');
    }
}
