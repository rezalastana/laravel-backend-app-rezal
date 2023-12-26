<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function login(Request $request)
    {
        // validate data email and password API
        $loginData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //take from user DB
        $user = User::where('email', $request->email)->first();

        //if user not found
        if (!$user) {
            return response([
                'message' => 'Email not found',
            ], 404);
        }

        //check hash password, bandingkan dari request dengan user dari db
        if (!Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'Password is wrong',
            ], 404);
        }

        // create token with plainTextToken
        $token = $user->createToken('auth_token')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token,
        ], 200);
    }
}
