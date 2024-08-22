<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    /**
     * Determine whether the user can view the model.
     * Both authenticated and unauthenticated users can view comments.
     * 
     * @return bool
     */
    public function view(): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     * Only authenticated users can add comments.
     * 
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user instanceof User;
    }

    /**
     * Determine whether the user can delete the model.
     * Only the author of the comment can delete it.
     * 
     * @return bool
     */
    public function delete(User $user, Comment $comment): bool
    {
        return $user->id === $comment->user_id;
    }
}
