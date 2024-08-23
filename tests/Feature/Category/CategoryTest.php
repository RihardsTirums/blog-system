<?php

namespace Tests\Feature\Category;

use Tests\TestCase;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Post $post;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->post = Post::factory()->create([
            'user_id' => $this->user->id,
            'title' => 'Test Post',
            'body_content' => 'Test Body Content',
        ]);
    }

    public function test_user_can_attach_categories_to_post(): void
    {
        $category = Category::factory()->create();

        $response = $this->actingAs($this->user)->patch(route('posts.update', $this->post->id), [
            'title' => $this->post->title,
            'body_content' => $this->post->body_content,
            'categories' => [$category->id],
        ]);

        $response->assertRedirect(route('posts.index'));

        $this->assertDatabaseHas('category_post', [
            'post_id' => $this->post->id,
            'category_id' => $category->id,
        ]);
    }

    public function test_user_can_update_post_categories(): void
    {
        $category = Category::factory()->create();
        $replacementCategory = Category::factory()->create();

        $this->post->categories()->attach($category);

        $this->assertDatabaseHas('category_post', [
            'post_id' => $this->post->id,
            'category_id' => $category->id,
        ]);

        $response = $this->actingAs($this->user)->patch(route('posts.update', $this->post->id), [
            'title' => $this->post->title,
            'body_content' => $this->post->body_content,
            'categories' => [$replacementCategory->id],
        ]);

        $response->assertRedirect(route('posts.index'));

        $this->assertDatabaseMissing('category_post', [
            'post_id' => $this->post->id,
            'category_id' => $category->id,
        ]);

        $this->assertDatabaseHas('category_post', [
            'post_id' => $this->post->id,
            'category_id' => $replacementCategory->id,
        ]);
    }
}