@extends($activeTemplate . 'layouts.master')

@section('content')
    <!-- Dashboard Body End -->
    <div class="dashboard-body">
        <div class="dashboard-body__bar d-lg-none d-block">
            <span class="dashboard-body__bar-icon"><i class="fas fa-bars"></i></span>
        </div>
        <div class="insurance-plan-wrapper">
            <div class="insurance-plan-wrapper__header">
                <h4 class="title"> @lang('Insurance Claim Form') </h4>
                <p class="text"> @lang('Easily file, track, and manage your claims hassle-free.') </p>
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
                                <div class="row gy-4">
                                    <div class="col-sm-6">
                                        <label for="name" class="form--label"> @lang('Your Name') </label>
                                        <input type="text" class="form--control" placeholder="Cameron Williamson" id="name">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="date" class="form--label"> @lang('Date of Birthday') </label>
                                        <input type="date" class="form--control" id="date">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form--label"> @lang('Gender') </label>
                                        <select class="form-select form--control select2">
                                            <option selected> Couple </option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="nid" class="form--label"> @lang('Identification Number (NID)') </label>
                                        <input type="number" class="form--control" placeholder="254879635825" id="nid">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form--label  label-two"> @lang('Phone Number') </label>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <select class="form-select form--control">
                                                    <option selected=""> US</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                            </div>
                                            <input type="text" class="form-control form--control" placeholder="+1 (555) 000-0000">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="mail" class="form--label"> @lang('Email Address') </label>
                                        <input type="email" class="form--control" placeholder="olivia@untitledui.com" id="mail">
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="btn--groups">
                                            <a href="{{ route('user.claim.insurance.request') }}" class="btn btn--base"> @lang('Next Step') <span class="btn-icon"> <i class="las la-arrow-right"></i> </span>
                                            </a>
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
