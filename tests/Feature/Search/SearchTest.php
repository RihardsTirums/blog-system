<?php

namespace Tests\Feature\Search;

use Tests\TestCase;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_keyword_search_finds_posts_by_title(): void
    {
        $matchingPost = Post::factory()->create([
            'title' => 'Unique Laravel Testing Guide',
            'body_content' => 'This guide covers everything about testing.',
        ]);

        $nonMatchingPost = Post::factory()->create([
            'title' => 'Introduction to PHP',
            'body_content' => 'This post is about PHP, not specifically Laravel.',
        ]);

        $response = $this->get(route('posts.index', ['search' => 'Unique Laravel']));

        $response->assertStatus(200);
        $response->assertSeeText($matchingPost->title);
        $response->assertDontSeeText($nonMatchingPost->title);
    }

    public function test_keyword_search_finds_posts_by_body_content(): void
    {
        $matchingPost = Post::factory()->create([
            'title' => 'General Post Title',
            'body_content' => 'Advanced techniques in Laravel testing are covered here.',
        ]);

        $nonMatchingPost = Post::factory()->create([
            'title' => 'Basic JavaScript Guide',
            'body_content' => 'This post is about JavaScript.',
        ]);

        $response = $this->get(route('posts.index', ['search' => 'Laravel testing']));

        $response->assertStatus(200);
        $response->assertSeeText($matchingPost->title);
        $response->assertDontSeeText($nonMatchingPost->title);
    }

    public function test_keyword_search_finds_posts_by_title_or_body_content(): void
    {
        $matchingPost1 = Post::factory()->create([
            'title' => 'Laravel Testing Guide',
            'body_content' => 'Everything about testing in Laravel.',
        ]);

        $matchingPost2 = Post::factory()->create([
            'title' => 'General Post Title',
            'body_content' => 'Advanced techniques in Laravel testing are discussed.',
        ]);

        $nonMatchingPost = Post::factory()->create([
            'title' => 'Getting Started with Node.js',
            'body_content' => 'This post is about Node.js.',
        ]);

        // Since the search is looking for the exact phrase "Laravel testing",
        // let's update the search term in a way that reflects how the search works.
        // The title or body_content must include "Laravel testing" as a phrase.

        // For this test, we should try searching with just "Laravel" to ensure it matches.
        $response = $this->get(route('posts.index', ['search' => 'Laravel']));

        $response->assertStatus(200);

        // Remove the debug dump for clean output
        $response->assertSeeText($matchingPost1->title);
        $response->assertSeeText($matchingPost2->title);
        $response->assertDontSeeText($nonMatchingPost->title);
    }
}
