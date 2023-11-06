<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function login()
    {
        return view('login');
    }

    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3',
            'user_type' => 'required|in:user,admin',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'user_type' => $request->input('user_type'),
        ]);

        Auth::login($user);

        if ($user->user_type === 'admin') {
            return back()->withSuccess('Add admin');
        } elseif ($user->user_type === 'user') {
            return back()->withSuccess('Add user');;
        }
    }

    public function signin(Request $request)
    {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        if ($user->user_type === 'user') {
            return redirect('/user/home');
        }
        else  if ($user->user_type === 'admin')
        {
            return redirect('/admin/home');
        }
    }
    return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function userHome()
    {
        $user = Auth::user();
        return view('user.home', compact('user'));
    }

    public function adminHome()
    {
        $user = Auth::user();
        return view('admin.home', compact('user'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function adminLogOut()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function userLogOut()
    {
        Auth::logout();
        return redirect('/login');
    }
}
