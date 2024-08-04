<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Models\Cart;
use App\Models\User;
use Auth;


class AuthController
{

    public function register(Request $request) {

        try {
            DB::beginTransaction();
            $userId = DB::table('users')->insertGetId([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'country' => $request->country,
                'password' => Hash::make($request->password),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            DB::table('carts')->insert([
                'user_id' => $userId,
            ]);
        
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating user and cart: ' . $e->getMessage());
            return response()->json([
                'status' => 'error' ,
                'message' => 'An error occurred while creating the user and cart.'
            ], 500);
        }

        $user = User::find($userId);
        $token = $user->createToken("auth_token")->plainTextToken;

        return response()->json([
            'status' => 'success',
            'access_token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone_number' => $user->phone_number,
                'country' => $user->phone_number,
            ],
        ]);
    }

    public function login(Request $request) {

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'access_token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone_number' => $user->phone_number,
                'country' => $user->phone_number,
            ],
        ]);
    }

    public function logout()
    {

        auth()->user()->tokens()->delete();

        return response()->json([
            'status' => 'success'
        ]);
    }

}
