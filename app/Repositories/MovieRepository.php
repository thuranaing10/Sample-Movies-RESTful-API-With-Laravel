<?php

namespace App\Repositories;
use App\Models\Movie;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class MovieRepository extends BaseRepository
{
    public function __construct(Movie $model)
    {
        $this->model = $model;
        $this->movieImagePath = "/images/movies/";
        $this->paginate = 10;
    }

    public function getMoviesList(){
        $movies = $this->model->latest()->paginate($this->paginate);
        return $movies;
    }

    public function createMovie($request){

        $coverImage = $request->coverImage;

        $imagePath = $this->uploadMovieImage($request->coverImage);

        $movie = $this->model->create([
            'title' => $request->title,
            'summary' => $request->summary,
            'cover_image' => $imagePath,
            'author_id' => Auth::user('api')->id,
            'imdb_ratings' => $request->imdbRatings,
            'pdf_link' => $request->pdfLink,
        ]);

        $movie->genres()->attach($request->genreIds);
        $movie->tags()->attach($request->tagIds);

        return true;

    }

    public function updateMovie($request){
        $movie = $this->model->where('author_id',Auth::user('api')->id)->where('id',$request->id)->first();

        if($movie == null){
            return false;
        }

        $imagePath = $movie->cover_image;

        if($request->coverImage){
            $imagePath = $this->uploadMovieImage($request->coverImage);

            $oldimage = public_path($movie->cover_image);
            if (file_exists($oldimage)) {
                @unlink($oldimage);
            }
        }

        $movie->update([
            'title' => $request->title,
            'summary' => $request->summary,
            'cover_image' => $imagePath,
            'author_id' => Auth::user('api')->id,
            'imdb_ratings' => $request->imdbRatings,
            'pdf_link' => $request->pdfLink,
        ]);

        $movie->genres()->sync($request->genreIds);
        $movie->tags()->sync($request->tagIds);

        return true;
    }

    public function deleteMovie($id){

        $movie = $this->model->where('author_id',Auth::user('api')->id)->where('id',$id)->first();

        if($movie == null){
            return false;
        }

        $oldimage = public_path($movie->cover_image);
        if (file_exists($oldimage)) {
            @unlink($oldimage);
        }

        $movie->genres()->detach();
        $movie->tags()->detach();

        $movie->delete();

        return true;
    }

    public function getMovieDetail($id){
        $movie = $this->model->whereId($id)->first();
        return $movie;
    }

    public function uploadMovieImage($coverImage){
        $imageName = Str::random(10) . '.' . '.png';

        $image_parts = explode(";base64,", $coverImage);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file = public_path() . $this->movieImagePath. $imageName;

        file_put_contents($file, $image_base64);

        $imagePath = $this->movieImagePath . $imageName;

        return $imagePath;

    }
}
