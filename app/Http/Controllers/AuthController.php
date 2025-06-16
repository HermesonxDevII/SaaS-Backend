<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller {
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string',
            'email'     => 'required|string|email|unique:users,email',
            'password'  => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error on registering user.',
                'errors'  => $validator->errors()
            ], 422, [], JSON_UNESCAPED_SLASHES);
        }

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            $token = $user->createToken('auth')->plainTextToken;

            return response()->json([
                'message' => 'User registered has successfully!',
                'token'   => $token
            ], 201, [], JSON_UNESCAPED_SLASHES);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error on registering user.',
                'errors'  => $e->getMessage()
            ], 500, [], JSON_UNESCAPED_SLASHES);
        }
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|string',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error on login user.',
                'errors'  => $validator->errors()
            ], 422, [], JSON_UNESCAPED_SLASHES);
        }

        try {
            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'message' => 'Error on login user.',
                    'errors'  => 'Invalid email or password.'
                ], 401, [], JSON_UNESCAPED_SLASHES);
            }

            $token = $user->createToken('auth')->plainTextToken;

            return response()->json([
                'message' => 'User logged has successfully!',
                'token'   => $token 
            ], 200, [], JSON_UNESCAPED_SLASHES);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error on login user.',
                'errors'  => $e->getMessage()
            ], 500, [], JSON_UNESCAPED_SLASHES);
        }
    }

    public function recovery_password(Request $request) {

    }

    public function email_verifier(Request $request) {

    }

    public function logout(Request $request) {

    }
}
