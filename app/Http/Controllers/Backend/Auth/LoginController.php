<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('admin.auth_management.login');
    }
    public function postLogin(Request $request)
    {
        $credentials = [
            'email' => $request['email'],
            'password' => $request['password'],
        ];
        if (Auth::attempt($credentials)) {
            // dd("Check check");
            // Authentication was successful
            return redirect()->route('dashboard');
        } else {
            // Authentication failed
            return redirect()->route('login.index')->with('error', 'Invalid credentials');
        }
    }
    public function logout()
    {
        Auth::logout();

        // If you want to redirect the user after logout, you can specify the route
        return redirect()->route('login.index');
    }
}
