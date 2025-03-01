<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavigationBottomLink extends Component
{
    public array $links;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->links = [
            ['route' => 'dashboard', 'label' => 'Übersicht', 'icon' => 'home'],
            ['route' => 'disciplines', 'label' => 'Disziplinen', 'icon' => 'goals'],
            ['route' => 'gamechanger.index', 'label' => 'Gamechanger', 'icon' => 'switch'],
            ['route' => 'audit.gamechanger', 'label' => 'History', 'icon' => 'history'],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navigation-bottom-link');
    }
}
