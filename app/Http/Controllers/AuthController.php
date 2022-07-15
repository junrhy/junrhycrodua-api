<?php

namespace App\Http\Controllers;

use App\Models\User;
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
            'brand_id' => 'required|uuid',
            'email' => 'unique:users,email,NULL,id,brand_id,'.$request->brand_id, // unique is brand_id + email_address
            'password' => 'required|string|confirmed',
            'access_type' => 'required|string',
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'brand_id' => $fields['brand_id'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $access = 'access:basic';
        if (!empty($fields['access_type'])) {
            if ($fields['access_type'] == 'admin') {
                $access = 'access:admin';
            } elseif ($fields['access_type'] == 'staff') {
                $access = 'access:staff';
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
            'brand_id' => 'required|uuid',
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        $user = User::where('brand_id', $fields['brand_id'])->where('email', $fields['email'])->first();

        // Check password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad credentials.'
            ], 401);
        }

        $access = 'access:basic';
        if ($request->filled('access_type')) {
            if ($request->access_type == 'admin') {
                $access = 'access:admin';
            } elseif ($request->access_type == 'staff') {
                $access = 'access:staff';
            }
        }

        $token = $user->createToken($user->name, [$access])->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
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
