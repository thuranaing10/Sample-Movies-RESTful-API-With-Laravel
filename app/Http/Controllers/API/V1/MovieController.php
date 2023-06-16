<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Requests\MovieRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\MovieResource;
use App\Repositories\MovieRepository;
use App\Http\Resources\MovieDetailResource;
use App\Http\Utilities\HttpResponseUtility;
use App\Http\Resources\MovieResourceCollection;

class MovieController extends Controller
{
    public function __construct(MovieRepository $movieRepo, HttpResponseUtility $httpResponseUtility)
    {
        $this->movieRepo = $movieRepo;
        $this->httpResponseUtility = $httpResponseUtility;
    }

    public function  getUserMoviesList()
    {
        $movies = $this->movieRepo->getUserMoviesList();

        return $this->httpResponseUtility->successResponse(MovieResource::collection($movies), "Success");
    }

    public function getMoviesList()
    {

        $movies = $this->movieRepo->getMoviesList();

        return $this->httpResponseUtility->successResponse(new MovieResourceCollection($movies), "Success");
    }

    public function createMovie(MovieRequest $request)
    {

        $movie = $this->movieRepo->createMovie($request);

        return $this->httpResponseUtility->successResponse(null, "Movie is uploaded successfully");
    }

    public function updateMovie(MovieRequest $request)
    {
        $movie = $this->movieRepo->updateMovie($request);

        if ($movie) {
            return $this->httpResponseUtility->successResponse(null, "Movie is updated successfully");
        } else {
            return $this->httpResponseUtility->badRequestResponse(null, "You cannot update this movie.");
        }
    }

    public function deleteMovie(Request $request)
    {

        $movie = $this->movieRepo->deleteMovie($request->id);

        if ($movie) {
            return $this->httpResponseUtility->successResponse(null, "Movie is deleted successfully");
        } else {
            return $this->httpResponseUtility->badRequestResponse(null, "You cannot delete this movie.");
        }
    }

    public function getMovieDetail(Request $request)
    {

        $movie = $this->movieRepo->getMovieDetail($request->id);

        return $this->httpResponseUtility->successResponse(new MovieDetailResource($movie), "Success");
    }
}
