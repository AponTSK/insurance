<?php
namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\ClaimRequest;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PolicyClaimConroller extends Controller
{
    public function pending($userId = null)
    {
        $claims = ClaimRequest::where('status', Status::CLAIM_PENDING)
            ->when($userId, function ($query) use ($userId) {
                return $query->where('user_id', $userId);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(getPaginate());

        $pageTitle = 'Pending Claims';
        return view('admin.policy_claim.pending', compact('pageTitle', 'claims'));
    }

    public function details($id)
    {
        $claim     = ClaimRequest::where('id', $id)->where('status', '!=', Status::CLAIM_SUCCESS)->where('status', '!=', Status::CLAIM_REJECT)->with(['insuredPlan', 'user', 'claimAttachments'])->firstOrFail();
        $pageTitle = 'Claim Request Details';
        $details   = $claim->others_details ? json_encode($claim->others_details) : null;

        return view('admin.policy_claim.detail', compact('pageTitle', 'claim', 'details'));
    }

    public function approve(Request $request)
    {
        $request->validate([
            'id'             => 'required|integer',
            'approve_amount' => 'required|numeric',
            'details'        => 'required',
        ]);
        $claim                 = ClaimRequest::where('id', $request->id)->where('status', Status::CLAIM_PENDING)->with('user')->firstOrFail();
        $claim->status         = Status::CLAIM_SUCCESS;
        $claim->admin_feedback = $request->details;
        $claim->approve_amount = $request->approve_amount;
        $claim->approve_date   = now();
        $claim->save();

        $user = $claim->user;
        $user->balance += $claim->approve_amount;
        $user->save();

        $transaction               = new Transaction();
        $transaction->user_id      = $claim->user_id;
        $transaction->amount       = $claim->approve_amount;
        $transaction->post_balance = $user->balance;
        $transaction->trx_type     = '+';
        $transaction->remark       = 'claim_accept';
        $transaction->details      = 'Claim accepted by admin';
        $transaction->trx          = getTrx();
        $transaction->save();

        notify($claim->user, 'CLAIM_APPROVE', [
            'claim_amount'   => showAmount($claim->approve_amount, currencyFormat: false),
            'post_balance'   => showAmount($claim->user->balance->balance, currencyFormat: false),
            'trx'            => $transaction->trx,
            'approve_date'   => $claim->approve_date,
            'admin_feedback' => $request->details,
        ]);

        $notify[] = ['success', 'Claim approved successfully'];
        return to_route('admin.policy_claim.pending', $claim->user_id)->withNotify($notify);
    }

    public function reject(Request $request)
    {
        $request->validate(['id' => 'required|integer']);
        $claim                 = ClaimRequest::where('id', $request->id)->where('status', Status::CLAIM_PENDING)->with('user')->firstOrFail();
        $claim->status         = Status::CLAIM_REJECT;
        $claim->admin_feedback = $request->details;
        $claim->save();

        notify($claim->user, 'CLAIM_REJECT', [
            'claim_id'     => $claim->id,
            'claim_amount' => showAmount($claim->approve_amount, currencyFormat: false),
            'post_balance' => showAmount($claim->user->balance, currencyFormat: false),
            'reason'       => $request->details,
        ]);

        $notify[] = ['success', 'Claim rejected successfully'];
        return to_route('admin.policy_claim.pending', $claim->user_id)->withNotify($notify);
    }

    public function acceptedClaim($userId = null)
    {
        $claims = ClaimRequest::where('status', Status::CLAIM_SUCCESS)
            ->when($userId, function ($query) use ($userId) {
                return $query->where('user_id', $userId);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(getPaginate());

        $pageTitle = 'Accepted Claims';
        return view('admin.policy_claim.accepted', compact('pageTitle', 'claims'));
    }

    public function rejectedClaim($userId = null)
    {
        $claims = ClaimRequest::where('status', Status::CLAIM_REJECT)
            ->when($userId, function ($query) use ($userId) {
                return $query->where('user_id', $userId);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(getPaginate());

        $pageTitle = 'Rejected Claims';
        return view('admin.policy_claim.rejected', compact('pageTitle', 'claims'));
    }

}
