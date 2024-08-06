<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Toolbar extends Component
{
    public $requires;
    /**
     * Create a new component instance.
     */
    public function __construct($require)
    {
        $this->requires = $require;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.toolbar');
    }
}
