<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class commentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            
            'content'=>$this->content ,
            'user'=>$this->user->name ,
            'post title'=>$this->post->title ,
            'post content'=>$this->post->content ,

        ];
    }
}
