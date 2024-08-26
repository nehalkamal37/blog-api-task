<?php

namespace App\Http\Controllers\posts;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Notifications\commentAdded;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class commentController extends Controller
{
    

    public function store(Request $request)
    {

        $request->validate([
            'content' => 'required|string|max:1255',
            
        ]);
        
    {
        $post=$request->post_id;

         $comment= Comment::create([
                'post_id'=>$post,
                'user_id'=>Auth::user()->id,
                'content'=> $request->content,
                
            ]);
           // this part is for email notifications
           // $post->user->notify(new commentAdded($post, $comment));
        
return redirect()->back()->with('success', 'Comment added successfully!');
        }
        
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment=Comment::findOrFail($id);
        $comment->delete();
        return redirect()->route('posts.index')->with('success', ' deleted successfully');
    }


}
