<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function register(Request $request) {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'unique:users,email,NULL,id',
            'password' => 'required|string|confirmed',
            'access_type' => 'string',
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $access = 'access:client';
        if (!empty($fields['access_type'])) {
            if ($fields['access_type'] == 'admin') {
                $access = 'access:admin';
            }
        }

        $token = $user->createToken($fields['name'], [$access])->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        $user = User::where('email', $fields['email'])
                ->first();

        // Check password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad credentials.',
                'success' => false
            ], 401);
        }

        $access = 'access:client';
        if ($request->filled('access_type')) {
            if ($request->access_type == 'admin') {
                $access = 'access:admin';
            }
        }

        $token = $user->createToken($user->name, [$access])->plainTextToken;

        Login::create([
            'user_id' => $user->id
        ]);

        $response = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'token' => $token,
            'success' => true
        ];

        return response($response, 201);
    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
}
