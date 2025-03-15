<?php
namespace App\Http\Controllers\User;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\InsuredPlan;

class UserPolicyController extends Controller
{
    public function policyList()
    {
        $pageTitle = 'Policy List';

        $insuredPlans = InsuredPlan::where('user_id', auth()->id())
            ->where('payment_status', Status::PAYMENT_SUCCESS)
            ->latest()
            ->with([
                'plan',
                'policyHolders',
            ])
            ->get();

        return view('Template::user.policy.policy_list', compact('pageTitle', 'insuredPlans'));
    }

}
