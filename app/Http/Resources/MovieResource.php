<?php

namespace App\Http\Resources;

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
        return [
            'id' => $this->id,
            'title' => $this->title,
            'summary' => $this->summary,
            'coverImage' => url($this->cover_image),
            'genreName' => $this->genre_id,
            'authorName' => $this->author_id,
            'tagId' => $this->tag_id,
            'imdbRatings' => $this->imdb_ratings,
            'pdfLink' => $this->pdf_link,
            // 'createdAt' => date('Y-m-d H:i:s', strtotime($this->created_at)),
            // 'chapterList' => count($chapterLists) ? ChapterListResource::collection($chapterLists) : null
        ];
    }
}
