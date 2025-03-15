<?php
namespace App\Http\Controllers\User;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Lib\FormProcessor;
use App\Models\Category;
use App\Models\Form;
use App\Models\GatewayCurrency;
use App\Models\InsuredPlan;
use App\Models\Plan;
use App\Models\PolicyHolder;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class UserPlanController extends Controller
{
    public function showInsuranceInfo($id = 0)
    {
        $pageTitle   = 'Insurance Plans';
        $plans       = Plan::Active()->get();
        $categories  = Category::Active()->get();
        $maxChildren = $plans->max('no_children');
        $maxCoverage = $plans->max('coverage_amount');

        return view('Template::user.plan_information.insurance', compact('plans', 'categories', 'pageTitle', 'maxChildren', 'maxCoverage'));
    }

    public function storeInsuranceInfo(Request $request, $id = 0)
    {

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'plan_id'     => 'required|integer',
        ]);

        $plan = Plan::where('category_id', $request->category_id)
            ->where('status', Status::ENABLE)->findOrFail($request->plan_id);

        if (! $plan) {
            $notify[] = ['error', 'No plans found matching your criteria.'];
            return redirect()->back()->withNotify($notify);
        }

        $insuredPlan                    = new InsuredPlan();
        $insuredPlan->user_id           = auth()->id();
        $insuredPlan->payment_status    = Status::PAYMENT_INITIATE;
        $insuredPlan->coverage          = $plan->coverage_amount;
        $insuredPlan->plan_id           = $plan->id;
        $insuredPlan->price             = $plan->price;
        $insuredPlan->renewal_date      = now()->addMonths($plan->validity)->format('Y-m-d');
        $insuredPlan->next_payment_date = now()->addDays($plan->payment_duration)->format('Y-m-d');
        $insuredPlan->validity          = $plan->validity;
        $insuredPlan->spouse_coverage   = $plan->spouse_coverage;
        $insuredPlan->children_coverage = $plan->children_coverage;
        $insuredPlan->no_children       = $plan->no_children;
        $insuredPlan->step              = Status::INSURANCE_STEP;
        $insuredPlan->policy_number     = '';
        $insuredPlan->save();

        $notify[] = ['success', 'Insurance information saved successfully.'];
        return redirect()->route('user.info', $insuredPlan->id)->withNotify($notify);
    }

    public function showUserInfo($id)
    {
        $pageTitle   = 'Your Information';
        $insuredPlan = InsuredPlan::where('user_id', auth()->id())
            ->where('payment_status', Status::PAYMENT_INITIATE)
            ->latest()->with('policyHolders', function ($query) use ($id) {
            $query->where('plan_purchase_id', $id)->where('type', Status::SELF_INFO);
        })->findOrFail($id);

        if ($insuredPlan->step < Status::INSURANCE_STEP) {
            $notify[] = ['error', 'Please complete the Insurance Information step first.'];
            return back()->withNotify($notify);
        }

        $policyHolder = $insuredPlan->policyHolders()->first();

        return view('Template::user.plan_information.user_info', compact('insuredPlan', 'policyHolder', 'pageTitle'));
    }

    public function storeUserInfo(Request $request, $id)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'date_of_birth' => 'required|date',
        ]);

        $insuredPlan = InsuredPlan::where('user_id', auth()->id())
            ->where('payment_status', Status::PAYMENT_INITIATE)
            ->latest()->with('policyHolders', function ($query) use ($id) {
            $query->where('plan_purchase_id', $id)->where('type', Status::SELF_INFO);
        })->findOrFail($id);

        if ($insuredPlan->step < Status::INSURANCE_STEP) {
            $notify[] = ['error', 'Please complete the Insurance Information step first.'];
            return back()->withNotify($notify);
        }

        $selfHolder = $insuredPlan->policyHolders()->first();

        if (! $selfHolder) {
            $selfHolder = new PolicyHolder();
        }

        $selfHolder->plan_purchase_id = $insuredPlan->id;
        $selfHolder->type             = Status::SELF_INFO;
        $selfHolder->name             = $request->name;
        $selfHolder->date_of_birth    = $request->date_of_birth;
        $form                         = Form::where('act', 'user')->firstOrFail();
        $formData                     = $form->form_data;
        $formProcessor                = new FormProcessor();
        $validationRule               = $formProcessor->valueValidation($formData);
        $request->validate($validationRule);
        $otherDetails              = $formProcessor->processFormData($request, $formData);
        $selfHolder->other_details = $otherDetails;
        $selfHolder->save();

        $insuredPlan->step = Status::YOUR_INFO_STEP;
        $insuredPlan->save();

        $notify[] = ['success', 'Your information saved successfully.'];
        return redirect()->route('user.spouse.info', $insuredPlan->id)->withNotify($notify);
    }

    public function showSpouseInfo($id)
    {
        $pageTitle = 'Spouse Information';

        $insuredPlan = InsuredPlan::where('user_id', auth()->id())
            ->where('payment_status', Status::PAYMENT_INITIATE)
            ->latest()
            ->with(['policyHolders' => function ($query) use ($id) {
                $query->where('plan_purchase_id', $id)
                    ->where('type', Status::SPOUSE_INFO);
            }])->findOrFail($id);

        if ($insuredPlan->step < Status::YOUR_INFO_STEP) {
            $notify[] = ['error', 'Please complete the Your Information step first.'];
            return redirect()->route('user.info')->withNotify($notify);
        }

        $policyHolder = $insuredPlan->policyHolders->first();

        return view('Template::user.plan_information.spouse', compact('insuredPlan', 'pageTitle', 'policyHolder'));
    }

    public function storeSpouseInfo(Request $request, $id)
    {
        $request->validate([
            'name'          => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
        ]);

        $insuredPlan = InsuredPlan::where('user_id', auth()->id())
            ->where('payment_status', Status::PAYMENT_INITIATE)
            ->latest()
            ->with(['policyHolders' => function ($query) use ($id) {
                $query->where('plan_purchase_id', $id)
                    ->where('type', Status::SPOUSE_INFO);
            }])->findOrFail($id);

        if ($insuredPlan->step < Status::YOUR_INFO_STEP) {
            $notify[] = ['error', 'Please complete the Your Information step first.'];
            return redirect()->route('user.info')->withNotify($notify);
        }

        $spouseHolder = $insuredPlan->policyHolders->first();

        if (! $spouseHolder) {
            $spouseHolder = new PolicyHolder();
        }

        $spouseHolder->plan_purchase_id = $insuredPlan->id;
        $spouseHolder->type             = Status::SPOUSE_INFO;
        $spouseHolder->name             = $request->name;
        $spouseHolder->date_of_birth    = $request->date_of_birth;

        $form           = Form::where('act', 'spouse')->firstOrFail();
        $formData       = $form->form_data;
        $formProcessor  = new FormProcessor();
        $validationRule = $formProcessor->valueValidation($formData);
        $request->validate($validationRule);
        $otherDetails                = $formProcessor->processFormData($request, $formData);
        $spouseHolder->other_details = $otherDetails;
        $spouseHolder->save();

        $insuredPlan->step = Status::SPOUSE_STEP;
        $insuredPlan->save();

        $notify[] = ['success', 'Spouse information saved successfully.'];
        return redirect()->route('user.nominee.info', $insuredPlan->id)->withNotify($notify);
    }

    public function showNomineeInfo($id)
    {

        $pageTitle = 'Nominee Information';

        $insuredPlan = InsuredPlan::where('user_id', auth()->id())
            ->where('payment_status', Status::PAYMENT_INITIATE)
            ->latest()
            ->with(['policyHolders' => function ($query) use ($id) {
                $query->where('plan_purchase_id', $id)
                    ->where('type', Status::NOMINEE_INFO);
            }])->findOrFail($id);

        if ($insuredPlan->step < Status::SPOUSE_STEP) {
            $notify[] = ['error', 'Please complete the Spouse Information step first.'];
            return redirect()->route('user.spouse.info')->withNotify($notify);
        }

        $policyHolder = $insuredPlan->policyHolders->first();

        return view('Template::user.plan_information.nominee', compact('insuredPlan', 'pageTitle', 'policyHolder'));
    }

    public function storeNomineeInfo(Request $request, $id)
    {
        $request->validate([
            'name'          => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
        ]);

        $insuredPlan = InsuredPlan::where('user_id', auth()->id())
            ->where('payment_status', Status::PAYMENT_INITIATE)
            ->latest()
            ->with(['policyHolders' => function ($query) use ($id) {
                $query->where('plan_purchase_id', $id)
                    ->where('type', Status::NOMINEE_INFO);
            }])->findOrFail($id);

        $nomineeHolder                   = new PolicyHolder();
        $nomineeHolder->plan_purchase_id = $insuredPlan->id;
        $nomineeHolder->type             = Status::NOMINEE_INFO;
        $nomineeHolder->name             = $request->name;
        $nomineeHolder->date_of_birth    = $request->date_of_birth;
        $form                            = Form::where('act', 'nominee')->firstOrFail();
        $formData                        = $form->form_data;
        $formProcessor                   = new FormProcessor();
        $validationRule                  = $formProcessor->valueValidation($formData);
        $request->validate($validationRule);
        $otherDetails                 = $formProcessor->processFormData($request, $formData);
        $nomineeHolder->other_details = $otherDetails;
        $nomineeHolder->save();

        $insuredPlan->step = Status::NOMINEE_STEP;
        $insuredPlan->save();

        $notify[] = ['success', 'Nominee information saved successfully.'];
        return redirect()->route('user.declaration', $insuredPlan->id)->withNotify($notify);
    }

    public function showDeclaration($id)
    {
        $pageTitle   = 'Declaration';
        $insuredPlan = InsuredPlan::where('user_id', auth()->id())
            ->where('payment_status', Status::PAYMENT_INITIATE)
            ->where('id', $id)
            ->with('policyHolders')
            ->latest()
            ->firstOrFail();

        return view('Template::user.plan_information.declaration', compact('insuredPlan', 'pageTitle'));
    }

    public function showPaymentInfo($insuredPlanId)
    {

        $insuredPlan = InsuredPlan::where('step', Status::NOMINEE_STEP)->findOrFail($insuredPlanId);

        $gatewayCurrency = GatewayCurrency::whereHas('method', function ($gate) {
            $gate->where('status', Status::ENABLE);
        })->with('method')->orderby('name')->get();

        $pageTitle = 'Payment';

        return view('Template::user.plan_information.payment', compact('insuredPlan', 'pageTitle', 'gatewayCurrency'));
    }

    public function paymentSuccess($insuredPlanId)
    {
        $insuredPlan = InsuredPlan::with('plan')->where('payment_status', Status::PAYMENT_SUCCESS)->findOrFail($insuredPlanId);
        $pageTitle   = 'Payment Success';
        return view('Template::user.plan_information.payment_success', compact('insuredPlan', 'pageTitle'));

    }

    public function insuranceDownload($insuredPlanId)
    {
        $insuredPlan = InsuredPlan::with('plan')->where('user_id', auth()->id())
            ->where('payment_status', Status::PAYMENT_SUCCESS)
            ->findOrFail($insuredPlanId);

        Config::set('dompdf.public_path', base_path());

        $pdf = Pdf::loadView('Template::user.plan_information.information_pdf', compact('insuredPlan'));

        return $pdf->download('insured_policy' . time() . '.pdf');
    }

}
