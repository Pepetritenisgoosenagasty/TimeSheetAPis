<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class AuthController extends Controller
{
    // public function register(Request $request) {
    //   $attr = $request->validate([
    //       'name'=> 'required|string',
    //       'email' => 'required|unique:users,email|string',
    //       'password' => 'required|string|confirmed'
    //   ]);


    //   $user = User::create([
    //       'name' => $attr['name'],
    //       'email' => $attr['email'],
    //       'password' => Hash::make($attr['password'])
    //   ]);

    //   $token = $user->createToken('myapptoken')->plainTextToken;

    //   $response = [
    //       'user' => $user,
    //       'token' => $token, 
    //   ];

    //   return response($response, 201);
    // }

    public function login(Request $request) {
        $attr = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
  
  
         //    Email Checks
         $user = User::where('email', 'admin@gmail.com')->first();

        //  Password Checks
        if (!$user || !Hash::check($attr['password'], $user->password)) {
            return response([
                "message" => "Invalid Credentials"
            ], 401);
        }
        
        // Generate Token
        $token = $user->createToken('myapptoken')->plainTextToken;
  
        $response = [
            'user' => $user,
            'token' => $token, 
        ];
  
        return response([$response, 201, "Login Successful"]);
      }


    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();

        return [
            "message" => "Logged Out"
        ];
    }
}
