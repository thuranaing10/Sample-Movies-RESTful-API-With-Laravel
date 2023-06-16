<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Repositories\CommentRepository;
use App\Http\Utilities\HttpResponseUtility;

class CommentController extends Controller
{
    public function __construct(CommentRepository $commentRepo, HttpResponseUtility $httpResponseUtility)
    {
        $this->commentRepo = $commentRepo;
        $this->httpResponseUtility = $httpResponseUtility;
    }

    public function createComment(CommentRequest $request){

        $this->commentRepo->createComment($request);

        return $this->httpResponseUtility->successResponse(null, "Comment is created successfully");
    }
}
