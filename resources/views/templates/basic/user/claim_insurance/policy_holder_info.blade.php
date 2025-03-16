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
                @include('Template::user.claim_insurance.claim_header', ['claimId' => @$claimRequest->id])

            </div>
            <div class="insurance-plan-wrapper__body">
                <div class="information-container">
                    <div class="row">
                        <div class="col-xl-9">
                            <form action="{{ route('user.claim.insurance.request.submit', @$claimRequest->id) }}" method="POST">
                                @csrf
                                <div class="row gy-4">
                                    <div class="col-sm-6">
                                        <label for="name" class="form--label"> @lang('Your Name') </label>
                                        <input type="text" name="name" class="form--control" value="{{ auth()->user()->fullname }}" readonly placeholder="Cameron Williamson" id="name">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="date" class="form--label"> @lang('Date of Birthday') </label>
                                        <input type="date" name="dob" class="form--control" id="date">
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="nid" class="form--label"> @lang('Identification Number (NID)') </label>
                                        <input type="number" name="nid" class="form--control" placeholder="254879635825" id="nid">
                                    </div>


                                    <div class="col-sm-6">

                                        <label class="form--label"> @lang('Phone Number') </label>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <select class="form-select form--control country-code" name="mobile_code">
                                                    @foreach ($countries as $key => $country)
                                                        <option value="{{ $country->dial_code }}" @if (auth()->user()->dial_code == $country->dial_code) selected @endif>
                                                            +{{ $country->dial_code }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <input type="number" value="{{ old('mobile', auth()->user()->mobile) }}" class="form-control form--control phone-number" name="mobile" required>
                                        </div>

                                    </div>
                                    <div class="col-sm-6">
                                        <label for="mail" class="form--label"> @lang('Email Address') </label>
                                        <input type="email" name="email" class="form--control" value="{{ old('email', auth()->user()->email) }}" placeholder="olivia@untitledui.com" id="mail">
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="btn--groups">
                                            <button type="submit" class="btn btn--base">
                                                @lang('Next Step') <span class="btn-icon"> <i class="las la-arrow-right"></i>
                                                </span>
                                            </button>
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
