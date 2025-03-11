<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Feature;
use App\Models\NotCover;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        $pageTitle = 'Manage Policy Plans';
        $plans     = Plan::with(['category', 'features', 'notCovers'])->whereHas('category', function ($query) {
            $query->active();
        })->orderBy('id', 'desc')->paginate(getPaginate());

        $categories = Category::active()->get();
        $features   = Feature::active()->get();
        $notCovers  = NotCover::active()->get();
        return view('admin.plan.index', compact('pageTitle', 'plans', 'categories', 'features', 'notCovers'));
    }

    public function save(request $request, $id = 0)
    {
        $request->validate([
            'category_id'       => 'required|exists:categories,id',
            'name'              => 'required|string|max:255|unique:plans,name,' . $id,
            'price'             => 'required|numeric|gt:0',
            'payment_duration'  => 'required|numeric|gt:0',
            'coverage_amount'   => 'required|numeric|gt:0',
            'validity'          => 'required|string',
            'spouse_coverage'   => 'boolean',
            'children_coverage' => 'boolean',
            'no_children'       => 'integer|min:1',
            'feature_id'        => 'required|array',
        ], [
            'feature_id.required' => 'At least one feature must be selected.',
            'feature_id.min'      => 'At least one feature must be selected.',
        ]);

        $features = Feature::whereIn('id', $request->feature_id)->active()->get();
        // $notCovers = NotCover::whereIn('id', $request->not_covere_id)->active()->get();

        if ($features->isEmpty()) {
            $notify[] = ['error', 'Please select at least one active feature.'];
            return back()->withNotify($notify);
        }

        if ($id) {
            $plan    = Plan::find($id);
            $message = "Plan updated successfully";
        } else {
            $plan    = new Plan();
            $message = "Plan added successfully";
        }

        // if ($request->has('feature_id')) {
        //     $features = Feature::whereIn('id', $request->feature_id)->active()->get();
        // }
        if ($request->has('not_cover_id')) {

            $notCovers = NotCover::whereIn('id', $request->not_cover_id)->active()->get();

        }

        $plan->category_id       = $request->category_id;
        $plan->name              = $request->name;
        $plan->price             = $request->price;
        $plan->payment_duration  = $request->payment_duration;
        $plan->coverage_amount   = $request->coverage_amount;
        $plan->validity          = $request->validity;
        $plan->spouse_coverage   = $request->spouse_coverage ?? 0;
        $plan->children_coverage = $request->children_coverage ?? 0;
        $plan->no_children       = $request->no_children ?? 0;
        $plan->save();

        $plan->features()->sync($features);
        $plan->notCovers()->sync($notCovers);

        $notify[] = ['success', $message];
        return back()->withNotify($notify);
    }

    public function toggleStatus($id)
    {
        return Plan::changeStatus($id);
    }
}
