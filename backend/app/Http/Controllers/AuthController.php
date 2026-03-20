<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(){
        if (Auth::check()) {
            return Auth::user()->role === 'admin' 
                ? redirect()->route('admin.dashboard') 
                : redirect()->route('questions.index');
        }
        return view('auth.login');
    }
   public function submitLogin(Request $request){

    $request->validate([
   
    'email' =>'required|email',
    'password' =>'required|min:6'

    ]);

     $credentials = $request->only('email' , 'password');

    if(Auth::attempt($credentials)){
    
    $request->session()->regenerate();
   
     if(Auth::user()->role === 'admin'){
      return redirect()->route('admin.dashboard');

     }
     return redirect()->route('questions.index');
    }

    return back()->withErrors([
     'email' =>'Email ou mot de passe incorrect'
   
    ])->onlyInput('email');

   }

    public function register()
    {
        if (Auth::check()) {
            return redirect()->route('questions.index');
        }
        return view('auth.register');
    }
  
   public function submitRegister(Request $request ){

    $request->validate([
      'email' =>'required|email|unique:users,email',
      'password' =>'required|min:6|confirmed',
      'name' =>'required|min:3'
    ]);

    $user = User::create([
     
     'name' =>$request->name,
     'email' =>$request->email,
     'password' => Hash::make($request->password),
      'role' =>'user'

    ]);

        Auth::login($user);

        return redirect()->route('questions.index')->with('success', 'Account created and logged in!');

   }

      public function logout(){
        Auth::logout();

           return redirect()->route('login');
    }






}


