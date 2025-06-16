<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller {
    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string',
            'email'     => 'required|string|email|unique:users,email',
            'password'  => 'required|string',
            'role'      => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error on creating user.',
                'errors'  => $validator->errors()
            ], 422, [], JSON_UNESCAPED_SLASHES);
        }

        try {
            User::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => Hash::make($request->password),
                'role'      => $request->role
            ]);

            return response()->json([
                'message' => 'User created has successfully!'
            ], 201, [], JSON_UNESCAPED_SLASHES);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error on creating user.',
                'errors'  => $e->getMessage()
            ], 500, [], JSON_UNESCAPED_SLASHES);
        }
    }

    public function list(Request $request) {
        try {
            $filters = [
                'id'     => $request->query('id'),
                'name'   => $request->query('name'),
                'email'  => $request->query('email'),
                'role'   => $request->query('role'),
                'active' => $request->query('active'),
                'limit'  => $request->query('limit')
            ];

            $query = User::query()->where('deleted', '<>', true);

            foreach ($filters as $filter => $value) {
                if (!is_null($value)) {
                    switch ($filter) {
                        case 'id':
                            $query->where($filter, (int) $value);
                            break;
                        case 'name':
                        case 'email':
                        case 'role':
                            $query->where($filter, (string) $value);
                            break;
                        case 'active':
                            $query->where($filter, filter_var($value, FILTER_VALIDATE_BOOLEAN));
                            break;
                        case 'limit':
                            $query->where($filter, (int) $value);
                            break;
                    }
                }
            }

            $users = $query->get();

            if ($users->isEmpty()) {
                return response()->json([
                    'message' => 'Error on listing users.',
                    'errors'  => 'User(s) not found.'
                ], 404, [], JSON_UNESCAPED_SLASHES);
            }

            return response()->json([
                'limit' => $filters['limit'],
                'total' => $users->count(),
                'data'  => $users
            ], 200, [], JSON_UNESCAPED_SLASHES);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error on listing users.',
                'errors'  => $e->getMessage()
            ], 500, [], JSON_UNESCAPED_SLASHES);
        }
    }

    public function edit(Request $request, int $id) {
        $validator = Validator::make($request->all(), [
            'name'      => 'nullable|string',
            'email'     => 'nullable|string',
            'password'  => 'nullable|string',
            'role'      => 'nullable|string',
            'active'    => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error on editing user.',
                'errors'  => $validator->errors()
            ], 422, [], JSON_UNESCAPED_SLASHES);
        }

        try {
            $user = User::where('id', $id)->where('deleted', '<>', true)->first();

            if (!$user) {
                return response()->json([
                    'message' => 'Error on editing user.',
                    'errors'  => 'User not found.'
                ], 404, [], JSON_UNESCAPED_SLASHES);
            }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = $request->role;
            $user->active = filter_var($request->active, FILTER_VALIDATE_BOOLEAN);
            $user->save();

            return response()->json([
                'message' => 'User edited has successfully!'
            ], 200, [], JSON_UNESCAPED_SLASHES);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error on editing user.',
                'errors'  => $e->getMessage()
            ], 500, [], JSON_UNESCAPED_SLASHES);
        }
    }

    public function delete(Request $request, int $id) {
        try {
            $user = User::where('id', $id)->where('deleted', '<>', true)->first();

            if (!$user) {
                return response()->json([
                    'message' => 'Error on deleting user.',
                    'errors'  => 'User not found.'
                ], 404, [], JSON_UNESCAPED_SLASHES);
            }

            $user->update([
                'deleted' => true
            ]);

            return response()->json([
                'message' => 'User deleted has successfully!'
            ], 200, [], JSON_UNESCAPED_SLASHES);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error on deleting user.',
                'errors'  => $e->getMessage()
            ], 500, [], JSON_UNESCAPED_SLASHES);
        }
    }
}
