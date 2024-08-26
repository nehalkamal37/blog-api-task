<?php
namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    
    public function user_can_create_a_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $this->assertDatabaseHas('posts', [
            'title' => $post->title,
            'content' => $post->content,
            'user_id' => $user->id,
        ]);
    }
}