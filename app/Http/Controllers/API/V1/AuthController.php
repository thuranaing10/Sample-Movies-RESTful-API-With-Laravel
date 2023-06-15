<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\ProfileResource;
use App\Http\Utilities\HttpResponseUtility;

class AuthController extends Controller
{
    public function __construct(AuthRepository $authRepo, HttpResponseUtility $httpResponseUtility)
    {
        $this->authRepo = $authRepo;
        $this->httpResponseUtility = $httpResponseUtility;
    }

    public function register(RegisterRequest $request){
        $user = $this->authRepo->createUser($request);

        $data = [
            'user' => new ProfileResource($user),
            'token' => $user->createToken('movie')->accessToken
        ];

        return $this->httpResponseUtility->successResponse($data, "Register successfully");
    }

    public function login(LoginRequest $request){

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $data = [
                "user" => new ProfileResource(Auth::user()),
                'token' =>  Auth::user()->createToken('movie')->accessToken

            ];

            return $this->httpResponseUtility->successResponse($data, "Login successfully");
        }
        else{
            return $this->httpResponseUtility->badRequestResponse(null, "Login Failed");
        }

    }
}
