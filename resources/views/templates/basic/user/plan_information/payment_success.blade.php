@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="dashboard-body">
        <div class="dashboard-body__bar d-lg-none d-block">
            <span class="dashboard-body__bar-icon"><i class="fas fa-bars"></i></span>
        </div>
        <div class="confirmation-container">
            <div class="confirmation-container__body">
                <span class="confirmation-container__icon">
                    <i class="las la-check-circle"></i>
                </span>
                <h3 class="confirmation-container__title">
                    <span class="d-block">
                        @lang('Congratulations!')
                    </span>
                    @lang('Your Insurance is Successfully Activated')
                </h3>
                <p class="confirmation-container__text">
                    @lang('You\'re now protected. Your policy details have been sent to your email.')
                </p>
                <div class="confirmation-card">
                    <ul class="info-list">
                        <li class="info-list__item">
                            <span class="info-list__title"> @lang('Policy Type:') </span>
                            <span class="info-list__text"> {{ __($insuredPlan->plan->name) }} </span>
                        </li>
                        <li class="info-list__item">
                            <span class="info-list__title"> @lang('Policy Number:') </span>
                            <span class="info-list__text"> #{{ $insuredPlan->policy_number }} </span>
                        </li>
                        <li class="info-list__item">
                            <span class="info-list__title"> @lang('Start Date:') </span>
                            <span class="info-list__text"> {{ showDateTime($insuredPlan->created_at, 'd M  y') }} </span>
                        </li>
                        <li class="info-list__item">
                            <span class="info-list__title"> @lang('Coverage Amount: ')</span>
                            <span class="info-list__text">{{ showAmount($insuredPlan->coverage) }}</span>
                        </li>
                    </ul>
                </div>
                <div class="d-flex flex-wrap gap-2 align-items-center justify-content-center mt-4">
                    <a href="{{ route('user.home') }}" class="btn btn--base"> @lang('Go to Dashboard') </a>
                    <a href="{{ route('user.insurance.download', $insuredPlan->id) }}" class="btn btn--white">@lang(' Download PDF') </a>
                </div>
            </div>
        </div>
    </div>
@endsection
