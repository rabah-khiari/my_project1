<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    
    public function dologin(LoginRequest $request)
    {
        // $user = new User();
        // $user->password = Hash::make('1234');
        // $user->email = 'ee@gmail.com';
        // $user->name = 'rabah2';
        // $user->save();
        
        $credential=$request->validated();
        if(Auth::attempt($credential)){
            $request->session()->regenerate();
            #return redirect()->route('blog.index');
            return redirect()->intended(route('blog.index')); #this save the url precendent to access 

        }
        return to_route('auth.login')->withErrors([
            'email'=>'email or password invalide'
        ]);
        
    }
    public function logout()
    {
        Auth::logout();
        return to_route('auth.login');
        
    }
}
