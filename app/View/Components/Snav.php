<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Snav extends Component
{
    public $active;
    public $href;
    public $icon;
    /**
     * Create a new component instance.
     */
    public function __construct($active, $href, $icon)
    {
        $this->active = $active;
        $this->href = $href;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.snav');
    }
}
