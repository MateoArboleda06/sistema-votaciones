<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        try {
            
            
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
        
            $user = User::where('email', $credentials['email'])->first();
    
            if (! $user || ! Hash::check($credentials['password'], $user->password)) {
                return response()->json(['message' => 'Credenciales incorrectas'], 401);
            }
    
            $token = $user->createToken('auth_token')->plainTextToken;
    
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user,
            ]);
        } catch (Exception $e) {
            dd($e);
        }
    }
}
