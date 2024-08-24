<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Class SearchForm
 *
 * A reusable search form component.
 *
 * @package App\View\Components
 */
class SearchForm extends Component
{
    /**
     * The form action URL.
     *
     * @var string
     */
    public string $action;

    /**
     * Create a new component instance.
     *
     * @param string $action
     * @return void
     */
    public function __construct(string $action = '/')
    {
        $this->action = $action;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render(): View|string
    {
        return view('components.search-form');
    }
}