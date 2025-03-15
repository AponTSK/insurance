@extends($activeTemplate . 'layouts.master')

@section('content')
    <!-- Dashboard Body End -->
    <div class="dashboard-body">
        <div class="dashboard-body__bar d-lg-none d-block">
            <span class="dashboard-body__bar-icon"><i class="fas fa-bars"></i></span>
        </div>
        <div class="insurance-plan-wrapper">
            <div class="insurance-plan-wrapper__header">
                <h4 class="title"> Insurance Claim Form </h4>
                <p class="text"> Easily file, track, and manage your claims hassle-free. </p>
                <div class="insurance-plan-wrapper__shape">
                    <img src="{{ asset($activeTemplateTrue . 'images/ds-2.png') }}" alt="image">
                </div>
            </div>
            <div class="plan-info">
                {{-- @include('Template::user.claim_insurance.claim_header') --}}
            </div>
            <div class="insurance-plan-wrapper__body">
                <div class="information-container">
                    <div class="row">
                        <div class="col-xl-9">
                            <form action="{{ route('user.claim.insurance.request.submit') }}" method="POST">
                                @csrf
                                <div class="single-claim-item">
                                    <h5 class="single-claim-item__title"> Insurance Information </h5>
                                    <div class="row gy-4">
                                        <div class="col-sm-6">
                                            <label class="form--label"> Select Your Insurance </label>
                                            <select class="form-select form--control select2 insuredPlan" name="insured_id">
                                                <option selected> Select One</option>
                                                @foreach ($insuredPlans as $insuredPlan)
                                                    <option data-pol_id="{{ $insuredPlan->policy_number }}" value="{{ $insuredPlan->id }}">{{ $insuredPlan->plan->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form--label"> Insurance ID</label>
                                            <input type="text" class="form--control insuranceId" readonly>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="btn--groups">
                                                <button type="submit" class="btn btn--base">
                                                    @lang('Next Step')
                                                    <span class="btn-icon">
                                                        <i class="las la-arrow-right"></i>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Dashboard Body End -->
@endsection

@push('script')
    <script>
        $('.insuredPlan').on('change', function() {
            let selectedPlan = $(this).find(':selected').data('pol_id');
            $('.insuranceId').val(selectedPlan);
        })
    </script>
@endpush
