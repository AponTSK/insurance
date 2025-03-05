@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h5 class="card-title">@lang('Health Insurance Plans')</h5>

                <div class="d-flex justify-content-between align-items-center bg-primary p-3 text-white">
                    <div>
                        <strong>@lang('Insurance For:')</strong> {{ $validatedData['member'] }}<br>
                        <strong>@lang('Insured Info:')</strong> {{ $validatedData['your_age'] }} @lang('Yrs'),
                        {{ $validatedData['spouse_age'] ?? 'N/A' }} @lang('Yrs'), {{ $validatedData['children_count'] == 1 ? '1 child' : $validatedData['children_count'] . ' children' }} <br>
                        <strong>@lang('Health Coverage Range:')</strong>
                        @if ($validatedData['coverage_amount'] === 'all')
                            @lang('All Plans')
                        @else
                            @lang('Up to') {{ showAmount($validatedData['coverage_amount']) }}
                        @endif
                    </div>
                </div>

                <div class="row mt-4">
                    @forelse($healthPlans as $plan)
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">@lang('Health Coverage')</h5>
                                    <p><strong>@lang('Premium:')</strong> {{ showAmount($plan->price) }}</p>
                                    <p><strong>@lang('Policy Duration:')</strong> {{ $plan->validity }} Year</p>
                                    <p><strong>@lang('Total Sum Insured:')</strong> {{ showAmount($plan->coverage_amount) }}</p>
                                    <button class="btn btn-primary">@lang('Buy Now')</button>
                                    <input type="checkbox" class="compare-checkbox" data-id="{{ $plan->id }}"> @lang('Add to Compare')
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center">@lang('No plans found matching your criteria.')</p>
                    @endforelse
                </div>

                <div class="mt-3">
                    <button id="compareBtn" class="btn btn-success compareBtn" disabled>@lang('Compare Plans')</button>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            "use strict";

            $(document).ready(function() {
                localStorage.removeItem("comparePlans");

                let selectedPlans = [];

                function updateButton() {
                    $('.compareBtn').prop('disabled', selectedPlans.length < 2);
                }

                $('.compare-checkbox').on('change', function() {
                    let planId = $(this).data('id');

                    if ($(this).is(':checked')) {
                        if (selectedPlans.length < 3) {
                            selectedPlans.push(planId);
                        } else {
                            alert("You can compare up to 3 plans.");
                            $(this).prop('checked', false);
                        }
                    } else {
                        selectedPlans = selectedPlans.filter(id => id !== planId);
                    }

                    updateButton();
                });

                $('.compareBtn').on('click', function() {
                    if (selectedPlans.length < 2) {
                        notify("error", "Please select at least two plans to compare!");
                        return;
                    }
                    window.location.href = "{{ route('compare.plan') }}?plans=" + selectedPlans.join(',');
                });

                updateButton();
            });
        </script>
    @endpush
@endsection
