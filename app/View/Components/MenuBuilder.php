<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MenuBuilder extends Component
{
    public $menuItem;
    /**
     * Create a new component instance.
     */
    public function __construct($menuItem)
    {
        $this->menuItem = $menuItem;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.menu-builder');
    }
}
