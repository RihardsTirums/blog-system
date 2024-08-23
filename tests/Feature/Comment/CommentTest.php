<?php

namespace Tests\Feature\Comment;

use Tests\TestCase;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Post $post;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->post = Post::factory()->create();
    }

    public function test_authenticated_user_can_create_comment(): void
    {
        $commentData = [
            'body_content' => 'This is a comment.',
        ];

        $response = $this->actingAs($this->user)->post(route('comments.store', $this->post->id), $commentData);

        $response->assertRedirect(route('posts.show', $this->post->id));

        $this->assertDatabaseHas('comments', [
            'body_content' => 'This is a comment.',
            'user_id' => $this->user->id,
            'post_id' => $this->post->id,
        ]);
    }

    public function test_unauthenticated_user_cannot_create_comment(): void
    {
        $commentData = [
            'body_content' => 'This is a comment.',
        ];

        $response = $this->post(route('comments.store', $this->post->id), $commentData);

        $response->assertRedirect(route('login'));

        $this->assertDatabaseMissing('comments', [
            'body_content' => 'This is a comment.',
        ]);
    }

    public function test_authenticated_user_can_only_delete_own_comment(): void
    {
        $ownComment = Comment::factory()->create([
            'user_id' => $this->user->id,
            'post_id' => $this->post->id,
            'body_content' => 'User\'s comment',
        ]);

        $otherUser = User::factory()->create();

        $otherComment = Comment::factory()->create([
            'user_id' => $otherUser->id,
            'post_id' => $this->post->id,
            'body_content' => 'Other user\'s comment',
        ]);

        $response = $this->actingAs($this->user)->delete(route('comments.destroy', $ownComment->id));
        $response->assertRedirect(route('posts.show', $this->post->id));
        $this->assertDatabaseMissing('comments', ['id' => $ownComment->id]);

        $response = $this->actingAs($this->user)->delete(route('comments.destroy', $otherComment->id));
        $response->assertForbidden();
        $this->assertDatabaseHas('comments', ['id' => $otherComment->id]);
    }
}
