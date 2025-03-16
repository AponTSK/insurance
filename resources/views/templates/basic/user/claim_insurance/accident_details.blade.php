@extends($activeTemplate . 'layouts.master')

@section('content')
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
                @include('Template::user.claim_insurance.claim_header', ['claimId' => $claimRequest->id])
            </div>
            <div class="insurance-plan-wrapper__body">
                <div class="information-container">
                    <div class="row">
                        <div class="col-xl-9">
                            <form action="{{ route('user.claim.insurance.accident.details.submit', $claimRequest->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf


                                <div class="single-claim-item">
                                    <div class="row gy-4">
                                        <div class="col-sm-6">
                                            <label class="form--label"> @lang('Select Your Insurance') </label>
                                            <select class="form-select form--control select2 insuredPlan" name="insured_id">
                                                <option selected> @lang('Select One')</option>
                                                @foreach ($insuredPlans as $insuredPlan)
                                                    <option data-pol_id="{{ $insuredPlan->policy_number }}" value="{{ $insuredPlan->id }}">{{ $insuredPlan->plan->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form--label"> @lang('Insurance ID')</label>
                                            <input type="text" class="form--control insuranceId" readonly>
                                        </div>
                                        <x-viser-form identifier="act" identifierValue="claim" />
                                        <div class="col-sm-6">
                                            <label for="amount" class="form--label"> @lang('Requested Amount') </label>
                                            <input type="number" name="amount" class="form--control" placeholder="10000" id="amount">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="date-two" class="form--label"> @lang('Accident Date') </label>
                                            <input type="date" name="accident_date" class="form--control" id="date-two">
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="des" class="form--label"> @lang('Description') </label>
                                            <textarea class="form--control" name="description" id="des" placeholder="@lang('Enter a description...')"></textarea>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="uploader-thumb">
                                                <div class="uploader-thumb__top">
                                                    <p class="title"> @lang('Upload Documents') </p>
                                                    <span class="text"> @lang('Add your documents here, and you can upload up to 5 files max') </span>
                                                </div>
                                                <div class="dragndrop">
                                                    <div class="form-group">
                                                        <div id="imageUploader"></div>
                                                    </div>
                                                </div>
                                            </div>
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

@push('css-lib')
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/img-uploader.main.css') }}">
@endpush
@push('script-lib')
    <script src="{{ asset($activeTemplateTrue . 'js/img-uploader.main.js') }}"></script>
@endpush

@push('script')
    <script>
        $(document).ready(function() {
            $('#imageUploader').imageUploader({
                maxFiles: 5
            });
        });



        $('.insuredPlan').on('change', function() {
            let selectedPlan = $(this).find(':selected').data('pol_id');
            $('.insuranceId').val(selectedPlan);
        })
    </script>
@endpush
