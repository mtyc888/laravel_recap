<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller{
    public function register(Request $request){
        $validated = $request->validated([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:100|unique:users',
            'password' => 'requried|string|min:8|confirmed'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        $token = $user->createToken('api');

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function login(Request $request){
        $validated = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $validated['email'])->first();
        if(!$user || !Hash::check($validated['password'], $user->password)){
            return response()->json(['message'=>'wrong credentials'], 401);
        }

        $token = $user->createToken('api');

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 200);
    }

    public function logout(Request $request){
        //delete all tokens from user
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'logged out'
        ]);
    }
}

?>
