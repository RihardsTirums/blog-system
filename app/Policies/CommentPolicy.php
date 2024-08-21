<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    /**
     * Determine whether the user can view the model.
     * Both authenticated and unauthenticated users can view comments.
     */
    public function view(User $user = null, Comment $comment): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     * Only authenticated users can add comments.
     */
    public function create(User $user): bool
    {
        return $user instanceof User;  // Only authenticated users can add comments
    }

    /**
     * Determine whether the user can delete the model.
     * Only the author of the comment can delete it.
     */
    public function delete(User $user, Comment $comment): bool
    {
        return $user->id === $comment->user_id;  // Only the comment's author can delete it
    }
}