<?php

namespace App\View\Components;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;
use Closure;

/**
 * Class PostForm
 *
 * A reusable component for creating and editing posts.
 *
 * @package App\View\Components
 */
class PostForm extends Component
{
    /**
     * The action URL for the form.
     *
     * @var string
     */
    public string $action;

    /**
     * The HTTP method for the form.
     *
     * @var string
     */
    public string $method;

    /**
     * The post instance.
     *
     * @var Post|null
     */
    public ?Post $post;

    /**
     * The categories available for selection.
     *
     * @var Collection
     */
    public Collection $categories;

    /**
     * The button text for the submit button.
     *
     * @var string
     */
    public string $buttonText;

    /**
     * Create a new component instance.
     *
     * @param string $action
     * @param string $method
     * @param Post|null $post
     * @param Collection $categories
     * @param string $buttonText
     */
    public function __construct(
        string $action,
        string $method = 'POST',
        ?Post $post = null,
        Collection $categories,
        string $buttonText = 'Submit'
    ) {
        $this->action = $action;
        $this->method = $method;
        $this->post = $post;
        $this->categories = $categories;
        $this->buttonText = $buttonText;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('components.post-form');
    }
}