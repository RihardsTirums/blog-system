<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * Class CommentController
 * @package App\Http\Controllers
 */
class CommentController extends Controller
{
    use AuthorizesRequests;

    /**
     * Store a newly created comment in storage.
     *
     * @param \App\Http\Requests\StoreCommentRequest $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCommentRequest $request, Post $post): RedirectResponse
    {
        $this->authorize('create', Comment::class);

        $post->comments()->create([
            'user_id' => $request->user()->id,
            'body_content' => $request->input('body_content'),
        ]);

        return redirect()->route('posts.show', $post)->with('success', 'Comment added successfully!');
    }

    /**
     * Remove the specified comment from storage.
     *
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Comment $comment): RedirectResponse
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return redirect()->route('posts.show', $comment->post_id)->with('success', 'Comment deleted successfully.');
    }
}
