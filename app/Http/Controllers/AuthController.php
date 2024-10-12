<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    
    public function dologin(LoginRequest $request)
    {
        $credential=$request->validated();
        if(Auth::attempt($credential)){
            $request->session()->regenerate();
            #return redirect()->route('blog.index');
            return redirect()->intended(route('blog.index')); #this save the url precendent to access 

        }
        return to_route('auth.login')->withErrors([
            'email'=>'email est invalide'
        ]);
        
    }
    public function logout()
    {
        Auth::logout();
        return to_route('auth.login');
        
    }
}
