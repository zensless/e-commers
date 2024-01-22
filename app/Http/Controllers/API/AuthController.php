<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // index regsitrasi
    public function register(Request $request) {
        $input = [
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'email' => $request->email
        ];

        $user = User::create($input);

        return response()->json([
            'status' => 'success',
            'message' => 'register sukses'
        ]);
    }

    public function login(Request $request) {
        $input = [
            'password' => $request->password,
            'email' => $request->email
        ];
        $user = User::where('email', $input['email'])->first();

        if (Auth::attempt($input)) {
            $token = $user->createToken('token')->plainTextToken;
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'login sukses',
                'token' => $token
            ]);
        } else {
            return response()->json([
                'code' => 401,
                'status' => 'error',
                'message' => 'login failled'
            ]);
        }
    }
}
