<?php

namespace App\Repositories;
use App\Models\User;
use App\Models\Comment;

class CommentRepository extends BaseRepository
{
    public function __construct(Comment $model)
    {
        $this->model = $model;
    }

    public function createComment($request){

        $input = [
            'movie_id' => $request->movieId,
            'email' => $request->email,
            'description' => $request->description,
        ];

        return $this->model->create($input);
    }
}
