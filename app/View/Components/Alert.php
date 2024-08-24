<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Class Alert
 *
 * A reusable component for displaying alert messages.
 *
 * @package App\View\Components
 */
class Alert extends Component
{
    /**
     * The message to display.
     *
     * @var string|null
     */
    public ?string $message;

    /**
     * Create a new component instance.
     *
     * @param string|null $message
     */
    public function __construct(?string $message = null)
    {
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render(): View|string
    {
        return view('components.alert');
    }
}