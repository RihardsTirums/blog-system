<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CommentController extends Controller
{
    use AuthorizesRequests;

    /**
     * Store a newly created comment in storage.
     */
    public function store(Request $request, Post $post): RedirectResponse
    {
        $validatedData = $request->validate([
            'body_content' => 'required|string',
        ]);

        $post->comments()->create([
            'user_id' => $request->user()->id,
            'body_content' => $validatedData['body_content'],
        ]);

        return redirect()->route('posts.show', $post)->with('success', 'Comment added successfully!');
    }

    /**
     * Remove the specified comment from storage.
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return redirect()->route('posts.show', $comment->post_id)->with('success', 'Comment deleted successfully.');
    }
}
