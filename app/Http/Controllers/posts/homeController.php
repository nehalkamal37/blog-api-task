<?php

namespace App\Http\Controllers\posts;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class homeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $posts=Post::all();
        $comments=Comment::all();

        return view('welcome',compact('posts','comments'));
    }

}