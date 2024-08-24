<?php

namespace App\View\Components;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Closure;

/**
 * Class PostCard
 *
 * A reusable component for displaying a post card with post details and actions.
 *
 * @package App\View\Components
 */
class PostCard extends Component
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
        $this->post = $post;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('components.post-card');
    }
}