<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SearchSelection extends Component
{
    public $callComponents, $options, $attrName, $attrLabel, $req, $valHidden, $valText;
    /**
     * Create a new component instance.
     */
    public function __construct($config)
    {
        $this->callComponents = $config['components'];
        if($config['components'] == 'view'){
            $this->options = $config['options'];
            $this->attrName = $config['name'];
            $this->attrLabel = $config['label'];
            $this->req = $config['request'];
            $this->valHidden = $config['value'];
            $this->valText = $config['text'];
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.search-selection');
    }
}
