<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that guests can view posts.
     *
     * @return void
     */
    public function test_guests_can_view_posts(): void
    {
        $post = Post::factory()->create();

        $response = $this->get(route('posts.index'));
        $response->assertStatus(200)
                 ->assertSee($post->title);

        $response = $this->get(route('posts.show', $post));
        $response->assertStatus(200)
                 ->assertSee($post->title)
                 ->assertSee($post->body_content);
    }

    /**
     * Test that authenticated users can view posts.
     *
     * @return void
     */
    public function test_authenticated_users_can_view_posts(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $response = $this->actingAs($user)->get(route('posts.index'));
        $response->assertStatus(200)
                 ->assertSee($post->title);

        $response = $this->actingAs($user)->get(route('posts.show', $post));
        $response->assertStatus(200)
                 ->assertSee($post->title)
                 ->assertSee($post->body_content);
    }

    /**
     * Test that guests cannot access create, edit, or delete post pages.
     *
     * @return void
     */
    public function test_guests_cannot_access_create_edit_or_delete_post_pages(): void
    {
        $post = Post::factory()->create();

        $response = $this->get(route('posts.create'));
        $response->assertRedirect(route('login'));

        $response = $this->get(route('posts.edit', $post));
        $response->assertRedirect(route('login'));

        $response = $this->delete(route('posts.destroy', $post));
        $response->assertRedirect(route('login'));
    }

    /**
     * Test that authenticated users can create, edit, and delete their own posts.
     *
     * @return void
     */
    public function test_authenticated_users_can_create_edit_and_delete_their_own_posts(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get(route('posts.create'));
        $response->assertStatus(200);

        $response = $this->actingAs($user)->get(route('posts.edit', $post));
        $response->assertStatus(200);

        $response = $this->actingAs($user)->delete(route('posts.destroy', $post));
        $response->assertRedirect(route('posts.index'))
                 ->assertSessionHas('success', 'Post deleted successfully.');
    }

    /**
     * Test that authenticated users cannot edit or delete others' posts.
     *
     * @return void
     */
    public function test_authenticated_users_cannot_edit_or_delete_others_posts(): void
    {
        $user = User::factory()->create();
        $anotherUser = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $anotherUser->id]);

        $response = $this->actingAs($user)->get(route('posts.edit', $post));
        $response->assertForbidden();

        $response = $this->actingAs($user)->delete(route('posts.destroy', $post));
        $response->assertForbidden();
    }
}
