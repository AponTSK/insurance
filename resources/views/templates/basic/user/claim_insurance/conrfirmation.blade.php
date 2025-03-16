@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="dashboard-body">
        <div class="confirmation-container">
            <div class="confirmation-container__body">
                <span class="confirmation-container__icon">
                    <i class="las la-check-circle"></i>
                </span>
                <h3 class="confirmation-container__title">
                    <span class="d-block">
                        @lang('Congratulations!')
                    </span>
                    @lang('Your Insurance claim is Successfully submited')
                </h3>
                <p class="confirmation-container__text">
                    @lang('we have received your claim request. Our team is reviewing it, and you will be updated shortly')
                </p>

                <div class="confirmation-card">
                    <ul class="info-list">
                        <li class="info-list__item">
                            <span class="info-list__title"> @lang('Claim Id:') </span>
                            <span class="info-list__text"> #{{ $claimRequest->claim_id }} </span>
                        </li>
                        <li class="info-list__item">
                            <span class="info-list__title"> @lang('Submitted On:') </span>
                            <span class="info-list__text"> {{ showDateTime($claimRequest->created_at, 'd M  y') }} </span>
                        </li>

                        <li class="info-list__item">
                            <span class="info-list__title"> @lang('Policy Number:') </span>
                            <span class="info-list__text"> #{{ $claimRequest->insuredPlan->policy_number }} </span>
                        </li>
                        <li class="info-list__item">
                            <span class="info-list__title"> @lang('Request Amount:') </span>
                            <span class="info-list__text"> {{ showAmount($claimRequest->request_amount) }} </span>
                        </li>
                    </ul>
                </div>

                <div class="d-flex flex-wrap gap-2 align-items-center justify-content-center mt-4">
                    <a href="{{ route('user.home') }}" class="btn btn--base"> @lang('Go to Dashboard') </a>
                    <a href="{{ route('user.claim.insurance.pdf.download', $claimRequest->id) }}" class="btn btn--white">@lang(' Download PDF') </a>
                </div>
            </div>
        </div>
    </div>
@endsection
