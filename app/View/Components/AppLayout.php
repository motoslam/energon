<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{

    public $title;

    public $wrapperCss;

    public function __construct($title, $wrapperCss)
    {
        $this->title = $title;

        $this->wrapperCss = $wrapperCss;
    }

    public function render()
    {
        return view('layouts.app');
    }
}
