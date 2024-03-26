<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

//public function login(){
//    echo "login endpoint";
//}

//public function login(Request $request){
//        $credentials = $request->only('email', 'password');
//
//        if (Auth::attempt($credentials)) {
//            $user = Auth::user();
//            $token = $user->createToken('OAuth')->accessToken;
//
//            return response()->json([
//                'token' => $token,
//                'email'=> $request->email,
//                'message' => 'Login successful'
//            ], 200);
//        }
//
//        return response()->json([
//            'message' => 'Unauthorized'
//        ], 401);
//
//}

    //http://localhost:8000/api/auth/login
public function login(Request $request){
    $credentials = request(['email','password']);

    if(!Auth::attempt($credentials)){
        return response()->json([
            'message'=> 'Invalid email or password'
        ],401);
    }
    $user= $request->user();
    $token= $user->createToken('Access Token');
    $user->access_token = $token->accessToken;
    return response()->json([
        'message' => 'Login successful',
        ' user'=>$user,
    ],200);

}

    //http://localhost:8000/api/auth/register
//public function register(){
//    echo "register endpoint";
//}
    public function register(Request $request) {
//        $request->validate([
//            'name' => 'required|string',
//            'email' => 'required|string|email|unique:users',
//            'password' => 'required|string|confirmed'
//        ]);

        // Retrieve the default role ("user")
        $defaultRole = Role::where('name', 'user')->first();

        // Create the user with the default role attached
        $user = $defaultRole->users()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
//        $user->roles()->attach($defaultRole);


        return response()->json([
            "message" => "User registered successfully"
        ], 201);
    }



//http://localhost:8000/api/logout
    public function logout(Request $request){
    $request->user()->token()->revoke();
    return response()->json([
        'message'=> "User logged out successfully"
    ],200);

    }

//http://localhost:8000/api/helloworld
public function index(){
    echo "hello world";
}



}
