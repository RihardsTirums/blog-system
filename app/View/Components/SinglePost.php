<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Post;

class SinglePost extends Component
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
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(): \Illuminate\Contracts\View\View|\Closure|string
    {
        return view('components.single-post');
    }
}
