<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use App\helpers\apiResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\commentResource;
use Illuminate\Support\Facades\Validator;

class commentController extends Controller
{
    public function all(){

        $comments=Comment::all();
        return commentResource::collection($comments);
    }
    
    public function one($id){
        
        try{
            $comment=Comment::where('id',$id)->firstOrFail();
    
        }catch(ModelNotFoundExeption $e){
    
            return apiResource::getResponse(404,'message not recieved successfully',[]);
    
        }
    
        return apiResource::getResponse(200,'message recieved successfully',new commentResource($comment));
    }    

    
    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'content' => 'required|string|max:1255',
        ]);
        $comment = Comment::create([
            'post_id' => $request->post_id,
            'content' => $request->content,
            'user_id'=>$request->user_id,
            
      ]  );
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'comment created successfully',
            'data' => $comment
        ], 201);
    
    }

    
    public function update(Request $request, string $id)
    {
        
    $data=Comment::findOrFail($request->id);

    $request->validate([
            'content' => 'string|max:1255',
    ]);
    
          $up=$data->update($request->all());

          return apiResource::getResponse(200,'Post updated successfully',new commentResource($data));

    }
    public function destroy(string $id)
    {
        $data=Comment::destroy($id);
      
      return apiResource::getResponse(200,'comment deleted successfully',[]);
      
      
    }

}
