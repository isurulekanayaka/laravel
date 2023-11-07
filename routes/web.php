<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/signup',[UserController::class, 'signup'])->name('signup');

Route::get('/signin', [UserController::class, 'showSigninForm'])->name('signin');

// Handle sign-in request
Route::post('/signin', [UserController::class, 'signin']);


Route::get('/admin/home', [UserController::class, 'adminHome'])->name('admin.home');
Route::get('/user/home', [UserController::class, 'userHome'])->name('user.home');

Route::post('/user/home', [UserController::class, 'userHome'])->name('user.home');
Route::post('/admin/home', [UserController::class, 'adminHome'])->name('admin.home');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::post('/post',[PostController::class,'post']);
Route::get('/post',[PostController::class,'post'])->name('post');

// Route::get('/user/home', [UserController::class, 'adminLogOut'])->name('admin.home');

// Route::post('/user/logout', [UserController::class, 'userLogOut'])->name('userlogout');
Route::get('/user/logout', [UserController::class, 'userLogOut'])->name('userlogout');

Route::get('/user/postView', [PostController::class, 'postView'])->name('user.postView');
Route::post('/user/postView', [UserController::class, 'postView'])->name('user.postView');


Route::get('/edit-post/{post}',[PostController::class,'ShowEdit']);
Route::get('/edit-post/{post}',[PostController::class,'EditPost']);
Route::delete('/delete-post/{post}',[PostController::class,'Delete']);
Route::get('/delete-post/{post}',[PostController::class,'Delete']);


Route::put('/edit-post/{post}', [PostController::class, 'EditPost'])->name('update-post');


Route::middleware('auth')->group(function () {

    // Show edit form
    Route::get('/edit-user/{user}', [UserController::class, 'ShowEdit']);
    
    // Update user
    Route::put('/edit-user/{user}', [UserController::class, 'EditUser'])->name('update-user');
    
    // Delete user
    Route::delete('/delete-user/{user}', [UserController::class, 'Delete']);


    Route::post('/admin/adduser', [UserController::class, 'addUser'])->name('admin.adduser');

    Route::get('/admin/adduser', [UserController::class, 'showAddUserForm'])->name('admin.adduser');
    Route::post('/admin/adduser', [UserController::class, 'showAddUserForm'])->name('admin.adduser');
});