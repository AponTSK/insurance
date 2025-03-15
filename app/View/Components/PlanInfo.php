<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PlanInfo extends Component
{

    public $insuredPlanId;

    /**
     * Create a new component instance.
     */
    public function __construct($insuredPlanId=null)
    {

        $this->insuredPlanId = $insuredPlanId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.plan-info');
    }
}
