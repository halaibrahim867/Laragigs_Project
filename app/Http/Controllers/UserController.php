<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    //show register /create form
    public function create(){
        return  view('users.register');
    }

    //store new user
    public function store(Request $request){
        $formFields =$request->validate([
            'name'=>['required','min:3'],
            'email'=>['required','email',Rule::unique('users','email')],
            'password'=>'required|confirmed|min:6'
        ]);

        //Hash password
        $formFields['password'] =bcrypt($formFields['password']);

        $user=User::create($formFields);

        //login
        auth()->login($user);

        return redirect('/')->with('message','User created and logged in');

    }
    //logout
    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->with('message','You have been logged out!');
    }

    //show login form
    public function login(){
        return view('users.login');
    }
}
