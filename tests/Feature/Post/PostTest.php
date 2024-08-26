<?php

namespace Tests\Feature\Post;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Category $category;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->category = Category::factory()->create();
    }

    public function test_authenticated_user_can_view_posts(): void
    {
        $posts = Post::factory(3)->create(['user_id' => $this->user->id]);

        $response = $this->actingAs($this->user)->get(route('posts.index'));

        $response->assertOk();

        $posts->each(function (Post $post) use ($response) {
            $response->assertSeeText(Str::limit($post->title, 50));
        });
    }

    public function test_unauthenticated_user_can_view_posts(): void
    {
        $posts = Post::factory(3)->create();

        $response = $this->get(route('posts.index'));

        $response->assertOk();

        $posts->each(function (Post $post) use ($response) {
            $response->assertSeeText(Str::limit($post->title, 50));
        });
    }

    public function test_authenticated_user_can_create_post(): void
    {
        $postData = [
            'title' => 'Test Post',
            'body_content' => 'This is the body of the test post.',
            'categories' => [$this->category->id],
        ];

        $response = $this->actingAs($this->user)->post(route('posts.store'), $postData);

        $response->assertRedirect(route('posts.index'));

        $this->assertDatabaseHas('posts', [
            'title' => 'Test Post',
            'body_content' => 'This is the body of the test post.',
            'user_id' => $this->user->id,
        ])->assertDatabaseHas('category_post', [
            'post_id' => Post::where('title', 'Test Post')->first()->id,
            'category_id' => $this->category->id,
        ]);
    }

    public function test_unauthenticated_user_cannot_create_post(): void
    {
        $postData = [
            'title' => 'Test Post',
            'body_content' => 'This is the body of the test post.',
            'categories' => [$this->category->id],
        ];

        $response = $this->post(route('posts.store'), $postData);

        $response->assertRedirect(route('login'));

        $this->assertDatabaseMissing('posts', [
            'title' => 'Test Post',
            'body_content' => 'This is the body of the test post.',
        ]);
    }

    public function test_authenticated_user_can_update_own_post(): void
    {
        $post = Post::factory()->create([
            'user_id' => $this->user->id,
            'title' => 'Original Title',
            'body_content' => 'Original Body Content',
        ]);

        $updateData = [
            'title' => 'Updated Title',
            'body_content' => 'Updated Body Content',
            'categories' => [$this->category->id],
        ];

        $response = $this->actingAs($this->user)->patch(route('posts.update', $post->id), $updateData);

        $response->assertRedirect(route('posts.index'));

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'title' => 'Updated Title',
            'body_content' => 'Updated Body Content',
        ])->assertDatabaseHas('category_post', [
            'post_id' => $post->id,
            'category_id' => $this->category->id,
        ]);
    }

    public function test_authenticated_user_cannot_update_another_users_post(): void
    {
        $anotherUser = User::factory()->create();

        $post = Post::factory()->create([
            'user_id' => $anotherUser->id,
            'title' => 'Original Title',
            'body_content' => 'Original Body Content',
        ]);

        $updateData = [
            'title' => 'Updated Title',
            'body_content' => 'Updated Body Content',
        ];

        $response = $this->actingAs($this->user)->patch(route('posts.update', $post->id), $updateData);

        $response->assertForbidden();

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'title' => 'Original Title',
            'body_content' => 'Original Body Content',
        ]);
    }

    public function test_authenticated_user_can_only_delete_own_post(): void
    {
        $ownPost = Post::factory()->create([
            'user_id' => $this->user->id,
            'title' => 'User\'s Post',
        ]);

        $otherUser = User::factory()->create();

        $otherPost = Post::factory()->create([
            'user_id' => $otherUser->id,
            'title' => 'Other User\'s Post',
        ]);

        $response = $this->actingAs($this->user)->delete(route('posts.destroy', $ownPost->id));
        $response->assertRedirect(route('posts.index'));
        $this->assertDatabaseMissing('posts', ['id' => $ownPost->id]);

        $response = $this->actingAs($this->user)->delete(route('posts.destroy', $otherPost->id));
        $response->assertForbidden();
        $this->assertDatabaseHas('posts', ['id' => $otherPost->id]);
    }
}