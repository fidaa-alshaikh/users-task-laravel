<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return User::select('users.*', 'cities.name as city_name', 
        'states.name as states_name', 'countries.name as country_name')
            ->leftJoin('cities', 'users.city_id', '=', 'cities.id')
            ->leftJoin('states', 'cities.state_id', '=', 'states.id')
            ->leftJoin('countries', 'states.country_id', '=', 'countries.id')
            ->latest()->paginate(4);
    }



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
        $formFields['city_id'] = $request->city_id ?? 0;
        $formFields['street'] = $request->street;
        if ($request->hasFile('file')) {
            $formFields['image_name'] = $request->file('file')->store('users-images', 'public');
        }

        $user = User::create($formFields);
        if ($user) {
            $response = [
                'user' => $user,
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::select('users.*', 'cities.name as city_name',
        'states.name as states_name', 'countries.name as country_name')
            ->leftJoin('cities', 'users.city_id', '=', 'cities.id')
            ->leftJoin('states', 'cities.state_id', '=', 'states.id')
            ->leftJoin('countries', 'states.country_id', '=', 'countries.id')
            ->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $formFields = $request->validate([
            'name' => 'required|min:3',
            'gender' => 'string',
            'city_id' => 'required',
        ]);

        //$formFields['image_name'] = $request->image_name;
        $formFields['street'] = $request->street;

        if ($request->hasFile('file')) {
            $formFields['image_name'] = $request->file('file')->store('users-images', 'public');
        }
        $user = User::findOrFail($id);
        $user->update($formFields);
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }
}
