<?php

namespace Tests\Feature\Validation;

use Tests\TestCase;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ValidationTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Post $post;
    protected Category $category;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->post = Post::factory()->create(['user_id' => $this->user->id]);
        $this->category = Category::factory()->create();
    }

    public function test_post_creation_requires_title(): void
    {
        $response = $this->actingAs($this->user)->post(route('posts.store'), [
            'title' => '',
            'body_content' => 'Test content',
            'categories' => [$this->category->id],
        ]);

        $response->assertSessionHasErrors(['title']);
    }

    public function test_post_creation_requires_body_content(): void
    {
        $response = $this->actingAs($this->user)->post(route('posts.store'), [
            'title' => 'Test Title',
            'body_content' => '',
            'categories' => [$this->category->id],
        ]);

        $response->assertSessionHasErrors(['body_content']);
    }

    public function test_post_creation_requires_at_least_one_category(): void
    {
        $response = $this->actingAs($this->user)->post(route('posts.store'), [
            'title' => 'Test Title',
            'body_content' => 'Test content',
            'categories' => [],
        ]);

        $response->assertSessionHasErrors(['categories']);
    }

    public function test_post_update_requires_title(): void
    {
        $response = $this->actingAs($this->user)->patch(route('posts.update', $this->post->id), [
            'title' => '',
            'body_content' => 'Updated content',
            'categories' => [$this->category->id],
        ]);

        $response->assertSessionHasErrors(['title']);
    }

    public function test_post_update_requires_body_content(): void
    {
        $response = $this->actingAs($this->user)->patch(route('posts.update', $this->post->id), [
            'title' => 'Updated Title',
            'body_content' => '',
            'categories' => [$this->category->id],
        ]);

        $response->assertSessionHasErrors(['body_content']);
    }

    public function test_post_update_requires_at_least_one_category(): void
    {
        $response = $this->actingAs($this->user)->patch(route('posts.update', $this->post->id), [
            'title' => 'Updated Title',
            'body_content' => 'Updated content',
            'categories' => [],
        ]);

        $response->assertSessionHasErrors(['categories']);
    }

    public function test_comment_creation_requires_body_content(): void
    {
        $response = $this->actingAs($this->user)->post(route('comments.store', $this->post->id), [
            'body_content' => '',
        ]);

        $response->assertSessionHasErrors(['body_content']);
    }
}
