<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\LoginUserRequest;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;
   public function __construct(UserRepositoryInterface $userRepository)
   {
      $this->userRepository = $userRepository;
   }
     public function register(RegisterUserRequest $validuserRequest)
     {
         $user = $this->userRepository->create($validuserRequest->validated());
          return response()->json(
            ["message"=> "Register successfully",
              "user"=> $user],201);
     }
     public function login(LoginUserRequest $validRequest)
     {
         $validUser=$validRequest->validated();
         if(!Auth::attempt($validUser)) 
            return response()->json(["message"=>"Email Or Password Is Invalid"],401);
        $user = Auth::user();
        $token=$user->createToken('auth_Token')->plainTextToken;
        return response()->json(["message"=>"Login successfully",
        "token"=>$token,"user"=>$user],200);
        
     }
     public function logout(Request $request)
     {
        $request->user()->currentAccessToken()->delete();
        return response()->json(["message"=> "logout successfully"],201);
     }
}
