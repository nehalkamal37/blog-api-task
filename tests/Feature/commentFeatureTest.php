<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function a_user_can_add_a_comment_to_a_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user)->post("/posts/{$post->id}/comments", [
            'content' => 'This is a comment',
        ]);

        $this->assertDatabaseHas('comments', [
            'content' => 'This is a comment',
            'post_id' => $post->id,
        ]);
    }
}