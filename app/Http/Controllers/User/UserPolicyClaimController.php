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
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class UserPolicyClaimController extends Controller
{
    public function claimInsuranceRequest($claimId)
    {

        $pageTitle = 'Policy Holder Information';

        $insuredPlans = InsuredPlan::with('plan')->where('user_id', auth()->id())
            ->where('payment_status', Status::PAYMENT_SUCCESS)
            ->get();

        $info         = json_decode(json_encode(getIpInfo()), true);
        $mobileCode   = @implode(',', $info['code']);
        $countries    = json_decode(file_get_contents(resource_path('views/partials/country.json')));
        $claimRequest = [];
        if ($claimId) {
            $claimRequest = ClaimRequest::where('id', $claimId)->where('user_id', auth()->id())->firstOrFail();
        }

        return view('Template::user.claim_insurance.policy_holder_info', compact('insuredPlans', 'claimRequest', 'mobileCode', 'countries', 'pageTitle'));
    }

    public function claimRequestSubmit(Request $request, $claimId)
    {
        $countryData = (array) json_decode(file_get_contents(resource_path('views/partials/country.json')));

        $mobileCodes = implode(',', array_column($countryData, 'dial_code'));

        $request->validate([
            'name'        => 'required',
            'dob'         => 'required|date',
            'mobile_code' => 'required|in:' . $mobileCodes,
            'mobile'      => 'required|numeric',
            'email'       => 'required|email',
            'nid'         => 'required|integer',
        ]);

        if ($claimId) {
            $claimInsurance = ClaimRequest::where('id', $claimId)->where('user_id', auth()->id())->firstOrFail();
        } else {
            $claimInsurance = new ClaimRequest();
        }

        $claimInsurance->user_id = auth()->id();
        $claimInsurance->phone   = $request->mobile_code . $request->mobile;
        $claimInsurance->email   = $request->email;
        $claimInsurance->nid     = $request->nid;
        $claimInsurance->dob     = $request->dob;
        $claimInsurance->step    = 1;
        $claimInsurance->save();

        $notify[] = ['success', 'Your claim policy holder information save successfully.'];

        return redirect()->route('user.claim.insurance.accident.details', $claimInsurance->id)->withNotify($notify);
    }

    public function accidentDetails($claimId)
    {
        $claimRequest = ClaimRequest::where('id', $claimId)->where('user_id', auth()->id())->firstOrFail();
        $insuredPlans = InsuredPlan::with('plan')->where('user_id', auth()->id())
            ->where('payment_status', Status::PAYMENT_SUCCESS)
            ->get();
        $pageTitle = 'Accident Details';
        return view('Template::user.claim_insurance.accident_details', compact('claimRequest', 'pageTitle', 'insuredPlans'));
    }

    public function accidentDetailsSubmit(Request $request, $claimId)
    {
        $request->validate([
            'insured_id'  => 'required|integer',
            'amount'      => 'required|integer|gt:0',
            'description' => 'required|string',
            'images'      => 'required|array|max:5',
            'images.*'    => ['image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ]);
        $insuredPlan = InsuredPlan::with('plan')->where('user_id', auth()->id())
            ->where('payment_status', Status::PAYMENT_SUCCESS)
            ->findOrFail($request->insured_id);

        if (! $insuredPlan) {
            $notify[] = ['error', 'Selected insured plan not found.'];
            return back()->withNotify($notify);
        }

        $claimRequest                    = ClaimRequest::where('user_id', auth()->id())->findOrFail($claimId);
        $claimRequest->plan_subscribe_id = $insuredPlan->id;
        $claimRequest->description       = $request->description;
        $claimRequest->request_amount    = $request->amount;

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

        return redirect()->route('user.claim.insurance.details.review', $claimRequest->id)->withNotify($notify);
    }

    public function detailsReview($claimId)
    {
        $claimRequest = ClaimRequest::with('user', 'insuredPlan.plan', 'claimAttachments')->where('user_id', auth()->id())->where('step', '>=', 2)->findOrFail($claimId);

        $pageTitle = 'Claim Details';
        return view('Template::user.claim_insurance.claim_details', compact('claimRequest', 'pageTitle'));
    }

    public function confirmSubmit($claimId)
    {
        $claimRequest = ClaimRequest::with('user', 'insuredPlan.plan', 'claimAttachments')->where('user_id', auth()->id())->where('step', '>=', 2)->findOrFail($claimId);
        $latestClaim  = ClaimRequest::latest()->first();
        $nextNumber   = $latestClaim ? ((int) str_replace('CLAIM-', '', $latestClaim->claim_id) + 1) : 1000;

        $claimRequest->step     = 3;
        $claimRequest->status   = status::CLAIM_PENDING;
        $claimRequest->claim_id = 'CLAIM-' . $nextNumber;
        $claimRequest->save();

        $pageTitle = 'Confirm Submission';
        // todo

        // user er kache mail jabe

        return view('Template::user.claim_insurance.conrfirmation', compact('claimRequest', 'pageTitle'));
    }

    public function downloadFile($attachmentId)
    {
        $attachment = ClaimAttachment::find(decrypt($attachmentId));
        if (! $attachment) {
            abort(404);
        }

        $claimRequest = ClaimRequest::where('user_id', auth()->id())->where('step', '>=', 2)->findOrFail($attachment->claim_request_id);
        if (! $claimRequest) {
            abort(404);
        }

        $file     = $attachment->attachment;
        $path     = getFilePath('claimAttachments');
        $fullPath = $path . '/' . $file;
        if (! file_exists($fullPath)) {
            $notify[] = ['error', 'Attachment not found'];
            return back()->withNotify($notify);
        }

        $title    = slug($claimRequest->insuredPlan->plan->name);
        $ext      = pathinfo($file, PATHINFO_EXTENSION);
        $mimetype = mime_content_type($fullPath);
        if (! headers_sent()) {
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: GET,');
            header('Access-Control-Allow-Headers: Content-Type');
        }
        header('Content-Disposition: attachment; filename="' . $title . '_' . time() . '.' . $ext . '";');
        header("Content-Type: " . $mimetype);
        return readfile($fullPath);
    }

    public function claimDownload($claimId)
    {
        $claimRequest = ClaimRequest::with('user', 'insuredPlan.plan', 'claimAttachments')->where('user_id', auth()->id())->where('step', '>=', 3)->findOrFail($claimId);

        Config::set('dompdf.public_path', base_path());

        $pdf = Pdf::loadView('Template::user.claim_insurance.claim_pdf', compact('claimRequest'));

        return $pdf->download('insured_policy' . time() . '.pdf');
    }
}
