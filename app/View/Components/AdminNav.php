<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AdminNav extends Component
{
    public $title;
    public $baseroute;
    public $dbid;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $title, string $baseroute, int $dbid)
    {
    $this->title = $title;
    $this->baseroute = $baseroute;
    $this->dbid = $dbid;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.admin-nav');
    }
}
