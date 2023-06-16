<?php

namespace App\Http\Resources;

use App\Models\Comment;
use App\Http\Resources\CommentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $comments = Comment::where('movie_id', $this->id)->get();

        return [
            'id' => $this->id,
            'title' => $this->title,
            'summary' => $this->summary,
            'coverImage' => url($this->cover_image),
            'imdbRatings' => $this->imdb_ratings,
            'comments' => count($comments) ? CommentResource::collection($comments) : null,
        ];
    }
}
