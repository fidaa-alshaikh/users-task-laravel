<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);
        $formFields['password'] = bcrypt($formFields['password']);
        $formFields['city_id'] = $request->city_id?? 0;
        $formFields['street'] = $request->street;
        if ($request->hasFile('file')) {
            $formFields['image_name'] = $request->file('file')->store('users-images', 'public');
        }

        $user = User::create($formFields);
        if($user){
        //Create token
        if(auth()->check()){
            $response = [
                'user' => $user,
                'status' => true,
                'message' => 'User created successfully.'
            ];
        }else{
            $token = $user->createToken('myAppToken')->plainTextToken;

            //auth()->login($user);
            $response = [
                'user' => $user,
                'token' => $token,
                'status' => true,
                'message' => 'User created successfully.'
            ];
        }

        return response($response, 201);
    }
    $response = [
        'status' => false,
        'message' => 'failed to create user.'
    ];
    return response($response, 401);

    }

    /**
     * Login user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request  $request)
    {
        $formFields = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if (auth()->attempt($formFields)) {
            $user = auth()->user();
            $token = $user->createToken('myAppToken')->plainTextToken;
            $response = [
                'user' => $user,
                'token' => $token,
                'status' => true,
                'message' => 'User logged in successfully.'
            ];
            return response($response, 201);
        }

        $response = [
            'status' => false,
            'message' => 'Bad credentials'
        ];
        return response($response, 401);
    }

    /**
     * Logout user
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        auth()->user()->tokens()->delete();
        $response = [
            'status' => true,
            'message' => 'User logged out successfully.'
        ];
        return response($response, 201);
    }

}
