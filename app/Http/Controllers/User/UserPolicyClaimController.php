<?php
namespace App\Http\Controllers\User;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Lib\FormProcessor;
use App\Models\ClaimAttachment;
use App\Models\ClaimRequest;
use App\Models\Form;
use App\Models\InsuredPlan;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;

class UserPolicyClaimController extends Controller
{
    public function index()
    {
        $insuredPlans = InsuredPlan::with('plan')->where('user_id', auth()->id())
            ->where('payment_status', Status::PAYMENT_SUCCESS)
            ->get();
        $pageTitle = 'Policy Holder Information';

        return view('Template::user.claim_insurance.policy_holder_info', compact('insuredPlans', 'pageTitle'));
    }
    public function claimInsuranceRequest()
    {
        $insuredPlans = InsuredPlan::with('plan')->where('user_id', auth()->id())
            ->where('payment_status', Status::PAYMENT_SUCCESS)
            ->get();
        $pageTitle = 'Policy Holder Information';

        return view('Template::user.claim_insurance.insurance_info', compact('insuredPlans', 'pageTitle'));
    }

    public function claimRequestSubmit(Request $request)
    {
        $request->validate([
            'insured_id' => 'required|integer',
        ]);

        $insuredPlan = InsuredPlan::with('plan')->where('user_id', auth()->id())
            ->where('payment_status', Status::PAYMENT_SUCCESS)
            ->findOrFail($request->insured_id);

        $claimInsurance                    = new ClaimRequest();
        $claimInsurance->plan_subscribe_id = $insuredPlan->id;
        $claimInsurance->user_id           = auth()->id();
        $claimInsurance->step              = 1;
        $claimInsurance->save();

        $notify[] = ['success', 'Your claim policy holder information save successfully.'];

        return redirect()->route('user.claim.insurance.accident.details', $claimInsurance->id)->withNotify($notify);
    }

    public function accidentDetails($claimId)
    {
        $claimRequest = ClaimRequest::where('id', $claimId)->where('user_id', auth()->id())->firstOrFail();
        $pageTitle    = 'Accident Details';
        return view('Template::user.claim_insurance.accident_details', compact('claimRequest', 'pageTitle'));
    }

    public function accidentDetailsSubmit(Request $request, $claimId)
    {
        $request->validate([
            'amount'      => 'required|integer|gt:0',
            'description' => 'required|string',
            'images'      => 'required|array|max:5',
            'images.*'    => ['image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ]);

        $claimRequest = ClaimRequest::where('user_id', auth()->id())->findOrFail($claimId);

        $claimRequest->description    = $request->description;
        $claimRequest->request_amount = $request->amount;

        $form           = Form::where('act', 'claim')->firstOrFail();
        $formData       = $form->form_data;
        $formProcessor  = new FormProcessor();
        $validationRule = $formProcessor->valueValidation($formData);
        $request->validate($validationRule);
        $otherDetails                 = $formProcessor->processFormData($request, $formData);
        $claimRequest->others_details = $otherDetails;
        $claimRequest->step           = 2;
        $claimRequest->save();

        $claimAttachments = $claimRequest->claimAttachments;

        if ($claimAttachments) {
            foreach ($claimAttachments as $attachment) {
                $path = getFilePath('claimAttachments') . '/' . $attachment->attachment;
                if (file_exists($path)) {
                    unlink($path);
                }
                $attachment->delete();
            }

        }

        foreach ($request->images as $image) {
            $attachment                   = new ClaimAttachment();
            $attachment->claim_request_id = $claimRequest->id;
            $attachment->attachment       = fileUploader($image, getFilePath('claimAttachments'));
            $attachment->save();
        }

        $notify[] = ['success', 'Your claim accident details save successfully.'];
        return redirect()->route('user.claim.insurance.details', $claimRequest->id)->withNotify($notify);

    }

    public function claimDetails($claimId)
    {
        $claimRequest = ClaimRequest::where('user_id', auth()->id())->where('step', '>=', 2)->firstOrFail($claimId);
        $pageTitle    = 'Claim Details';
        return view('Template::user.claim_insurance.claim_details', compact('claimRequest', 'pageTitle'));
    }

}
