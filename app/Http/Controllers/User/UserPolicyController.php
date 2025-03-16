<?php
namespace App\Http\Controllers\User;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\ClaimRequest;
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
    public function claimList()
    {
        $pageTitle = 'Claim List';

        $claimRequests = ClaimRequest::where('user_id', auth()->id())
            ->latest()
            ->with('insuredPlan.plan')
            ->get();

        return view('Template::user.policy.claim_list', compact('pageTitle', 'claimRequests'));
    }

}
