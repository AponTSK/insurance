@extends($activeTemplate . 'layouts.master')

@section('content')
    <div class="dashboard-body">
        <div class="insurance-plan-wrapper">
            <x-plan-info />
            <div class="insurance-plan-wrapper__body">
                <div class="information-container">
                    <div class="row">
                        <div class="col-xl-9">
                            <form method="POST" action="{{ route('user.store.insurance.info') }}">
                                @csrf
                                <div class="row gy-4">
                                    <div class="col-sm-6">
                                        <label class="form--label">@lang('Select Your Insurance')</label>
                                        <select class="form-select form--control select2" id="category_id" name="category_id" required>
                                            <option value="">@lang('Select Insurance Type')</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ __($category->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="form--label">@lang('Coverage Amount')</label>
                                        <select class="form-select form--control select2" id="coverage_amount" name="plan_id" required>
                                            <option>@lang('Select One')</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn--base">@lang('Next Step') <span class="btn-icon"><i class="las la-arrow-right"></i></span></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";

            const plans = @json($plans);
            const $coverageSelect = $('#coverage_amount');

            $('#category_id').on('change', function() {
                let categoryId = $(this).val();
                $coverageSelect.empty().append('<option>@lang('Select One')</option>');

                if (categoryId) {
                    plans
                        .filter(plan => plan.category_id == categoryId)
                        .forEach(plan => {
                            $coverageSelect.append(`<option value="${plan.id}">@lang('Up to') ${parseFloat(plan.coverage_amount).toFixed(2)}</option>`);
                        });
                }
            }).trigger('change');

        })(jQuery);
    </script>
@endpush
