<?php

namespace App\View\Components;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Closure;

/**
 * Class DisplayComments
 *
 * A reusable component for displaying comments associated with a post.
 *
 * @package App\View\Components
 */
class DisplayComments extends Component
{
    /**
     * The post instance.
     *
     * @var Post
     */
    public Post $post;

    /**
     * Create a new component instance.
     *
     * @param  Post  $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post->load(['comments.user']);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('components.display-comments');
    }
}