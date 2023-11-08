<?php

namespace App\Http\Controllers;
// namespace App\Http\Controllers\UserControllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function post(Request $request){
        $incomingFields = $request->validate([
            'postTitle'=>'required',
            'postBody'=>'required'
        ]);
        $incomingFields['title']=strip_tags($incomingFields['postTitle']);
        $incomingFields['body']=strip_tags($incomingFields['postBody']);
        $incomingFields['user_id']=auth()->id();
        Post::create($incomingFields);
        return view('user/home');
    }
    
    public function postView()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $post = $user->posts;
            return view('user/postView', compact('post'));
        }

        return redirect()->route('login'); // Redirect to login page if user is not authenticated
    }

    public function EditPost(Post $post,Request $request)
    {
        if(auth()->user()->id !==$post ['user_id'])
        {
            return redirect('/');
        }
        $incomingFields = $request->validate([
            'title'=>'required',
            'body'=>'required'
        ]);
        $incomingFields['title'] = trim(strip_tags($incomingFields['title']));
        $incomingFields['body'] = trim(strip_tags($incomingFields['body']));

        $post->update($incomingFields);
        return redirect('user/postView');
    }

    public function ShowEdit(Post $post)
    {
        if(auth()->user()->id !==$post ['user_id'])
        {
            return redirect('/');
        }
        return view('user/postView',['post'=>$post]);
    }

    public function Delete(Post $post)
    {
        if(auth()->user()->id ===$post['user_id']){
            $post->delete();
        }
        return redirect('user/postView');
    }
    
    public function search(Request $request)
    {
        $query = $request->input('query');

        $results = Post::where('title', 'like', '%' . $query . '%')
                ->orWhere('body', 'like', '%' . $query . '%')
                ->orWhereHas('user', function($queryUser) use ($query) {
                    $queryUser->where('name', 'like', '%' . $query . '%');
                })
                ->with('user')
                ->get();


        return view('user/postShow', compact('results'));
    }

}
