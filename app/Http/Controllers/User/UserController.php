<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    //
    public function register(){
        return view ('register');
    }

    public function login(){
        return view ('login');
    }

    
    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
            'password' => 'required'
        ]);

        $data = $request->except('_token');

        $isEmailExist = User::where('email', $request->email)->exists();
    
        if($isEmailExist){
            return back()->withErrors([
                'email' => 'This email already exixst'
            ])->withInput();
        }

        $data['password'] = Hash::make($request->password);
       

        User::create($data);

        return redirect()->route('user.login')->with('success',"Your Account created successfull");
    }

    public function auth(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email','password');

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            return redirect()->route('user.dashboard');
        }else{
            return back()->withErrors([
                'credentials' => 'your email & password are wrong'
            ])->withInput();
        }
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('user.login');
    
    }
}
