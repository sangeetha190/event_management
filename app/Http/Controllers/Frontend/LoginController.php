<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    //
    public  function index()
    {
        // return view('frontend.Auth.login');
        // Redirect authenticated users away from the login page
        if (Auth::check()) {
            return redirect()->route('home.index');
        }

        return view('frontend.Auth.login');
    }
    public function register()
    {
        return view('frontend.Auth.register');
    }
    public function store(Request $request)
    {
        // Validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];

        // Custom error messages
        $messages = [
            'password.confirmed' => 'The password confirmation does not match.',
        ];

        // Validate the incoming request
        $validator = Validator::make($request->all(), $rules, $messages);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create and store the new user
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        // Redirect to a success page or wherever you need
        return redirect()->route('index');
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
            return redirect()->route('home.index');
        } else {
            // Authentication failed
            return redirect()->route('frontend.Auth.login')->with('error', 'Invalid credentials');
        }
    }
    public function logout()
    {
        Auth::logout();

        // If you want to redirect the user after logout, you can specify the route
        return redirect()->route('home.index');
    }
}
