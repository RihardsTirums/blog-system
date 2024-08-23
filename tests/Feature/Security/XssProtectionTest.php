<?php

namespace Tests\Feature\Security;

use Tests\TestCase;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;

class XssProtectionTest extends TestCase
{
    use RefreshDatabase;

    protected Post $post;
    protected Comment $comment;

    protected function setUp(): void
    {
        parent::setUp();

        $this->post = Post::factory()->create([
            'title' => 'Safe Title',
            'body_content' => '<script>alert("XSS Attack");</script> This is a post body.',
        ]);

        $this->comment = Comment::factory()->create([
            'post_id' => $this->post->id,
            'body_content' => '<script>alert("XSS Attack");</script> This is a comment.',
        ]);
    }

    public function test_post_content_is_sanitized(): void
    {
        $response = $this->get(route('posts.show', $this->post->id));

        $response->assertStatus(200);
        $response->assertDontSee('<script>alert("XSS Attack");</script>', false);
        $response->assertSee('This is a post body.');
    }

    public function test_comment_content_is_sanitized(): void
    {
        $response = $this->get(route('posts.show', $this->post->id));

        $response->assertStatus(200);
        $response->assertDontSee('<script>alert("XSS Attack");</script>', false);
        $response->assertSee('This is a comment.');
    }
}
