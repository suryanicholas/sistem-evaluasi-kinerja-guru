<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;
use Illuminate\View\Component;

class Breadcrumb extends Component
{
    public $href;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $bc = explode('/', Request::path());
        return view('components.breadcrumb',[
            'paths' => $bc,
            'url' => ''
        ]);
    }
}
