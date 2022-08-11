<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        $user = User::create($formFields);
        if ($user) {
            $token = $user->createToken('myAppToken')->plainTextToken;

            //auth()->login($user);
            $response = [
                'user' => $user,
                'token' => $token,
                'status' => true,
                'message' => 'User created successfully.'
            ];
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

    /**
     *  Change password
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function change_password(Request $request)
    {
        $formFields = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string',
            'password_confirmation' => 'required|string|same:new_password',
        ]);
        $user_password = auth()->user()->password;
        $user_id = auth()->user()->id;

        if (Hash::check($formFields['new_password'], $user_password)) {
            $response = [
                'status' => false,
                'message' => 'New password should not be equal to current password.'
            ];
            return response($response);
        } elseif (Hash::check($formFields['current_password'], $user_password)) {
            $user = User::find($user_id);
            if ($user) {
                $user->update(['password' => bcrypt($formFields['new_password'])]);
                $response = [
                    'status' => true,
                    'message' => 'Password has been changed successfully.'
                ];
                return response($response, 201);
            }
        } else {
            $response = [
                'status' => false,
                'message' => 'Failed to change password.'
            ];
            return response($response);
        }
    }
}
