<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class PostPolicy
 * @package App\Policies
 */
class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @return bool
     */
    public function view(): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     * Only authenticated users can add post.
     * 
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user instanceof User;
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Post $post
     * @return bool
     */
    public function update(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Post $post
     * @return bool
     */
    public function delete(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }
}
