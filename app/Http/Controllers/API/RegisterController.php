<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use App\Models\User;


class RegisterController extends Controller
{
    public function register(Request $request){
        $data['username'] = $request->input('studentId');
        $data['password'] = Hash::make('000000');
        $data['password_changed'] = false;

        try {
             $newUser = User::create([
                'username' => $data['username'],
                'password' => $data['password'],
                'password_changed' => $data['password_changed']
            ]);
            return response()->json($newUser);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th);
        }

        
    }
}
