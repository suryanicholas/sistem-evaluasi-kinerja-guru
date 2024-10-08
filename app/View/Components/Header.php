<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header extends Component
{
    public $evaluation, $title;
    public $authority = [
        'admin' => 'primary',
        'master' => 'warning'
    ];
    /**
     * Create a new component instance.
     */
    public function __construct($content)
    {
        $this->title = $content['title'] ? $content['title'] : '' ;
        if(isset($content['respondent'])){
            $this->evaluation = $content['respondent'] ? $content['respondent'] : false;
        } elseif(isset($content['respondent'])){
            $this->evaluation = $content['evaluation'] ? $content['evaluation'] : false;
        } else {
            $this->evaluation = false;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.header');
    }
}
