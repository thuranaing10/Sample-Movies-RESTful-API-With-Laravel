<?php

namespace App\Repositories;
use App\Models\Movie;
use Illuminate\Support\Str;

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

        $this->model->create([
            'title' => $request->title,
            'summary' => $request->summary,
            'cover_image' => $imagePath,
            'genre_id' => $request->genreId,
            'author_id' => $request->authorId,
            'tag_id' => $request->tagId,
            'imdb_ratings' => $request->imdbRatings,
            'pdf_link' => $request->pdfLink,
        ]);

        return true;

    }

    public function updateMovie($request){
        $movie = $this->model->where('id',$request->id)->first();

        $imagePath = $movie->cover_image;

        if($request->coverImage){
            $imagePath = $this->uploadMovieImage($request->coverImage);

            $oldimage = public_path($imagePath);
            if (file_exists($oldimage)) {
                @unlink($oldimage);
            }
        }

        $movie->update([
            'title' => $request->title,
            'summary' => $request->summary,
            'cover_image' => $imagePath,
            'genre_id' => $request->genreId,
            'author_id' => $request->authorId,
            'tag_id' => $request->tagId,
            'imdb_ratings' => $request->imdbRatings,
            'pdf_link' => $request->pdfLink,
        ]);

        return true;
    }

    public function deleteMovie($id){

        $movie = $this->model->findOrFail($id);

        $oldimage = public_path($movie->cover_image);
        if (file_exists($oldimage)) {
            @unlink($oldimage);
        }

        $movie->delete();

        return true;
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
