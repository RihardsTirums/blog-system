<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use App\Models\Post;

/**
 * Class AddComment
 *
 * A reusable component for displaying a form to add comments to a post.
 *
 * @package App\View\Components
 */
class AddComment extends Component
{
    /**
     * The post instance.
     *
     * @var \App\Models\Post
     */
    public Post $post;

    /**
     * Create a new component instance.
     *
     * @param  \App\Models\Post  $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|\Closure|string
     */
    public function render(): View|\Closure|string
    {
        return view('components.add-comment');
    }
}
