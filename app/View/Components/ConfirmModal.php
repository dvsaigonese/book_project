<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ConfirmModal extends Component
{
    public $status;
    public $url;
    public $method;
    /**
     * Create a new component instance.
     */
    public function __construct($status, $url, $method)
    {
        $this->status = $status;
        $this->url = $url;
        $this->method = $method;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.confirm-modal');
    }
}
