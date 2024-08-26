<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\helpers\apiResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\postResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class postController extends Controller
{
    public function all(){

        $posts=Post::all();
        return postResource::collection($posts);
    }
    public function one($id){
        
        try{
            $post=Post::where('id',$id)->firstOrFail();
    
        }catch(ModelNotFoundExeption $e){
    
            return apiResource::getResponse(404,'message not recieved successfully',[]);
    
        }
    
        return apiResource::getResponse(200,'message recieved successfully',new postResource($post));
    }    

    
    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:155',
            'content' => 'required|string|max:1255',
        ]);
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id'=>$request->user_id,
            
      ]  );
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }

       
        // Return a success response
        return response()->json([
            'success' => true,
            'message' => 'post created successfully',
            'data' => $post
        ], 201);
    
    }
    public function update(Request $request, string $id)
    {
        
    $data=Post::findOrFail($request->id);

    $request->validate([
            'title' => 'string|max:155',
            'content' => 'string|max:1255',
        

    ]);
    
          $up=$data->update($request->all());

          return apiResource::getResponse(200,'Post updated successfully',new postResource($data));

    }
    public function destroy(string $id)
    {
        $data=Post::destroy($id);
      
      return apiResource::getResponse(200,'Post deleted successfully',[]);
      
      
    }
}
