<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InvoiceActions extends Component
{
    /**
     * Create a new component instance.
     */

    public $invoice;

    public function __construct($invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.invoice-actions');
    }
}
