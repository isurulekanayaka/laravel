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
        $users = \App\Models\User::all();
        return view('admin.home', compact('users'));
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


    public function ShowEdit(User $user)
    {
        if(auth()->user()->id !== $user->id)
        {
            return redirect('/');
        }
        return view('admin/home',['user'=>$user]);
    }

    public function EditUser(User $user, Request $request)
    {
        
        $incomingFields = $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $user->update($incomingFields);
        return redirect('admin/home');
    }

    public function Delete(User $user)
    {
        // Delete related posts first
        $user->posts()->delete(); // Assuming you have a posts relationship defined in your User model
    
        // Now you can safely delete the user
        $user->delete();
    
        return redirect('admin/home');
    }
    

    public function showAddUserForm(){
        return view('admin.adduser');
    }

    public function addUser(Request $request){
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Create a new user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.adduser')->with('success', 'User added successfully!');
    }
}
