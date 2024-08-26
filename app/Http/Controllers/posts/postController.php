<?php

namespace App\Http\Controllers\posts;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class postController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts=Post::with('comments')->where('user_id',Auth::user()->id)->get();
        $c=Comment::all();
        
        return view('front.index',compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:1255',
            
        ]);
        Post::create([
            'title'=>$request->title,
            'user_id'=>Auth::user()->id,
            'content'=> $request->content,
            

        ]);

        return redirect()->route('posts.index')->with('success', ' created successfully');
    }

 
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        $post=Post::find($id);
        return view('posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post=Post::find($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:1255',
            
        ]);
        $post->update($request->all());

        return redirect()->route('posts.index')->with('success', ' updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post=Post::findOrFail($id);
        $post->delete();
        return redirect()->route('posts.index')->with('success', ' deleted successfully');

    }
}
