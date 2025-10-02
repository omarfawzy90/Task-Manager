<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    
    public function register(Request $request)
    {
        $request->validate([
            "name" => "required|string|max:255",
            "email" => "string|email|max:100|unique:users,email",
            "password" => "required|string|min:8|confirmed",
        ]);

        $user = User::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>Hash::make($request->password)
        ]);
        Mail::to($user->email)->send(new WelcomeMail($user));
        return response()->json(['message'=>'User created succssefully', 'User'=>$user],201);
    }


     public function login(Request $request)
    {
        $request->validate([
            "email"=>"required|string|email",
            "password"=>"required|string",
        ]);

        if(!Auth::attempt($request->only("email","password")))
        return response()->json(['message'=>"invalid email or passowed"], 401);
        

        $user = User::where('email', $request->email)->FirstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['message'=>'Login succssfully', 'User'=>$user, 'Token' => $token],201);
    }



     public function logout(Request $request)
    {   
        $request->user()->currentAccessToken()->delete();
        return response()->json(["message" => "logout successful"]);
    }
    
    
    
    
    public function getprofile($id)
    {
       $user =  User::find($id)->profile;
       return response()->json($user,200);
    }

    public function getuser()
    {
        $userID = Auth::user()->id;
        $user = User::with('profile')->findOrFail($userID);
        return new UserResource($user);
    }

    public function getusertasks($id)
    {
        $tasks = User::findOrFail($id)->tasks;
        return response()->json($tasks,200);
    }
}
