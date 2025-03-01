<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class NavigationLink extends Component
{
    public string $webRoute;
    public bool $active;

    /**
     * Create a new component instance.
     */
    public function __construct(string $webRoute)
    {
        $this->webRoute = $webRoute;
        $currentRoute = request()->route()->getName();

        // Check if the current route name contains the provided webRoute
        $this->active = Str::contains($currentRoute, $webRoute);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navigation-link');
    }
}
