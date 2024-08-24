<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use App\Models\Post;
use Closure;

/**
 * Class SinglePost
 *
 * A reusable component for displaying a single post with its details.
 *
 * @package App\View\Components
 */
class SinglePost extends Component
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
        return view('components.single-post');
    }
}