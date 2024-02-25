<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string',
            'phone_number' => 'required|string',
            'password' => 'required'
        ]);
        return User::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return User::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $user = User::find($id);
        $user->update($request->all());
        return $user;
    }

    // Change Password
    public function changePassword(Request $request,$id){
        # Validation
        $fields = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required',
        ]);
       
        $user = User::find($id);
        #Match The Old Password
        if(!Hash::check($fields['current_password'], $user->password)){
            $response = [
                'status'=> 400,
                'error_message' => "Old Password doesn't Match",
            ];

            return response()->json($response, 400);
        }

        #Update the new Password
        $user->update([
            'password' => Hash::make($fields['new_password'])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return User::destroy($id);
    }
}
