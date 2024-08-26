<?php

namespace App\Http\Controllers\posts;

use App\Models\Post;
use App\Models\Comment;
use App\Mail\mailgunEmail;
use Illuminate\Http\Request;
use App\Notifications\commentAdded;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
//use App\Http\Controllers\posts\Mail;

class mailController extends Controller
{
    /**
     * Display a listing of the resource.
     */

public function store(Request $request, $postId)
{
    $post = Post::findOrFail($postId);

    $comment = new Comment();
    $comment->content = $request->input('content');
    $comment->user_id = auth()->id();
    $comment->post_id = $post->id;
    $comment->save();

    $post->user->notify(new commentAdded($post, $comment));

    return redirect()->back()->with('message', 'Comment added successfully!');
}



    public function index()
    {
        Mail::to('hi@example.com')->send(new mailgunEmail('you have a new comment'));
        $posts=Post::where('user_id',Auth::user()->id)->get();
        $comments=Comment::all();
        
        return view('front.index',compact('posts','comments'));
    }

   
}
