<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $imageRule = 'required';
        if ($this->method() == 'PUT') {
            $imageRule = 'nullable';
        }

        return [
            'title' => 'required',
            'summary' => 'required',
            'coverImage' => $imageRule,
            'genreId' => 'required',
            'authorId' => 'required',
            'tagId' => 'required',
            'imdbRatings' => 'required',
            'pdfLink' => 'required',
        ];
    }
}
