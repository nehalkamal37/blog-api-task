<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_logged_in_user_can_create_a_post()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post('posts.store', [
            'title' => 'My Post',
            'content' => 'Here is the content of My post',
        ]);

        $this->assertDatabaseHas('posts',
         ['title' => 'My Post']);
    }
}