<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    //
    public function register(Request $request){

        try {
            $fields = $request->validate([
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'email' => 'required|string',
                'phone_number' => 'required|string',
                'password' => 'required|string',
            ]);

            $userE = User::where('email',$fields['email'])->first();
            $userP = User::where('phone_number',$fields['phone_number'])->first();

            if($userE ){
                return response([
                            'message' => 'Email already exists!',
                        ],500);
            }elseif($userP){
                return response([
                            'message' => 'Phone number already exists!',
                        ],500);
            }else{
                $user = User::create([
                    'first_name' => $fields['first_name'],
                    'last_name' => $fields['last_name'],
                    'email' => $fields['email'],
                    'phone_number' => $fields['phone_number'],
                    'password' => bcrypt($fields['password']),
                    
                ]);

                $token = $user->createToken('myapptoken')->plainTextToken;

                $response = [
                    'user' => $user,
                    'token' => $token,
                    'userE' => $userE
                ];

                return response($response, 201);
            }
            
            
        } catch (\Throwable $th) {

            $response = [
                'status'=> 500,
                'error_message' => "Something went wrong",
                'error' => $th->getMessage(),
            ];

            return response()->json($response, 500);
        }
    }

    public function login(Request $request){
        try {
            //code...
            $fields = $request->validate([
                'email' => 'required|string',
                'password' => 'required|string',
            ]);
    
            //Check email
            $user = User::where('email',$fields['email'])->first();
            //Check password
            if(!$user || !Hash::check($fields['password'],$user->password ))
            {
                return response([
                    'message' => 'Invalid credentials',
                    
                ],401);
            }
    
            $token = $user->createToken('myapptoken')->plainTextToken;
    
            $response = [
                'user' => $user,
                'token' => $token,
            ];
    
            return response($response);

        } catch (\Throwable $th) {
            //throw $th;
            $response = [
                'status'=> 500,
                'error_message' => "Something went wrong",
                'error' => $th->getMessage(),
            ];

            return response()->json($response, 500);
        }
        
    }

    
    

    public function logout(Request $request){
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
}