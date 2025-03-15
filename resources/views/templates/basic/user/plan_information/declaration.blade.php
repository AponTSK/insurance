@extends($activeTemplate . 'layouts.master')

@section('content')
    <div class="dashboard-body">
        <div class="insurance-plan-wrapper">
            <x-plan-info insuredPlanId="{{ $insuredPlan->id }}" />
            <div class="insurance-plan-wrapper__body">
                <div class="row">
                    <div class="col-xxl-10">
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="info-wrapper">
                                    <h6 class="info-wrapper__title">
                                        @lang('Policy Information')
                                    </h6>
                                    <div class="info-card">
                                        <ul class="info-list">
                                            <li class="info-list__item">
                                                <span class="info-list__title">
                                                    @lang('Policy Name')
                                                </span>
                                                <span class="info-list__text">
                                                    {{ $insuredPlan->plan->name ?? 'N/A' }}
                                                </span>
                                            </li>
                                            <li class="info-list__item">
                                                <span class="info-list__title">
                                                    @lang('Policy Duration')
                                                </span>
                                                <span class="info-list__text">
                                                    {{ $insuredPlan->validity }} @lang('Year', ['count' => $insuredPlan->validity], 'Years')
                                                </span>
                                            </li>
                                            <li class="info-list__item">
                                                <span class="info-list__title">
                                                    @lang('Coverage Amount')
                                                </span>
                                                <span class="info-list__text">
                                                    {{ showAmount($insuredPlan->coverage) }}
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="info-main-container">
                                <div class="info-wrapper">
                                    <h6 class="info-wrapper__title">
                                        @lang('Insured Information')
                                    </h6>
                                    <div class="info-card">
                                        <ul class="info-list">
                                            @php
                                                $selfHolder = $insuredPlan->policyHolders->where('type', Status::SELF_INFO)->first();
                                            @endphp
                                            <li class="info-list__item">
                                                <span class="info-list__title">
                                                    @lang('Insured')
                                                </span>
                                                <span class="info-list__text">
                                                    {{ $selfHolder->name ?? 'N/A' }}
                                                </span>
                                            </li>
                                            <li class="info-list__item">
                                                <span class="info-list__title">
                                                    @lang('NID Number')
                                                </span>
                                                @if ($selfHolder->other_details)
                                                    <span class="info-list__text">
                                                        @foreach ($selfHolder->other_details as $val)
                                                            @if ($val->name == 'NID')
                                                                {{ __($val->value) }}
                                                            @endif
                                                        @endforeach
                                                    </span>
                                                @endif
                                            </li>
                                            <li class="info-list__item">
                                                <span class="info-list__title">
                                                    @lang('Phone Number')
                                                </span>
                                                @if ($selfHolder->other_details)
                                                    <span class="info-list__text">
                                                        @foreach ($selfHolder->other_details as $val)
                                                            @if ($val->name == 'Phone Number')
                                                                {{ __($val->value) }}
                                                            @endif
                                                        @endforeach
                                                    </span>
                                                @endif
                                            </li>

                                            <li class="info-list__item">
                                                <span class="info-list__title">
                                                    @lang('Date of Birth')
                                                </span>
                                                <span class="info-list__text">
                                                    {{ $selfHolder->date_of_birth ?? 'N/A' }}
                                                </span>
                                            </li>
                                            <li class="info-list__item">
                                                <span class="info-list__title">
                                                    @lang('Gender')
                                                </span>
                                                @if ($selfHolder->other_details)
                                                    <span class="info-list__text">
                                                        @foreach ($selfHolder->other_details as $val)
                                                            @if ($val->name == 'Gender')
                                                                {{ __($val->value) }}
                                                            @endif
                                                        @endforeach
                                                    </span>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="info-wrapper">
                                    <h6 class="info-wrapper__title">
                                        @lang('Spouse Information')
                                    </h6>
                                    <div class="info-card">
                                        <ul class="info-list">
                                            @php
                                                $spouseHolder = $insuredPlan->policyHolders->where('type', Status::SPOUSE_INFO)->first();
                                            @endphp
                                            <li class="info-list__item">
                                                <span class="info-list__title">
                                                    @lang('Insured')
                                                </span>
                                                <span class="info-list__text">
                                                    {{ $spouseHolder->name ?? 'N/A' }}
                                                </span>
                                            </li>
                                            <li class="info-list__item">
                                                <span class="info-list__title">
                                                    @lang('NID Number')
                                                </span>
                                                @if ($spouseHolder->other_details)
                                                    <span class="info-list__text">
                                                        @foreach ($spouseHolder->other_details as $val)
                                                            @if ($val->name == 'NID')
                                                                {{ __($val->value) }}
                                                            @endif
                                                        @endforeach
                                                    </span>
                                                @endif
                                            </li>
                                            <li class="info-list__item">
                                                <span class="info-list__title">
                                                    @lang('Phone Number')
                                                </span>
                                                @if ($spouseHolder->other_details)
                                                    <span class="info-list__text">
                                                        @foreach ($spouseHolder->other_details as $val)
                                                            @if ($val->name == 'Phone Number')
                                                                {{ __($val->value) }}
                                                            @endif
                                                        @endforeach
                                                    </span>
                                                @endif
                                            </li>

                                            <li class="info-list__item">
                                                <span class="info-list__title">
                                                    @lang('Date of Birth')
                                                </span>
                                                <span class="info-list__text">
                                                    {{ $spouseHolder->date_of_birth ?? 'N/A' }}
                                                </span>
                                            </li>
                                            <li class="info-list__item">
                                                <span class="info-list__title">
                                                    @lang('Gender')
                                                </span>
                                                <span class="info-list__text">
                                                    @if ($spouseHolder->other_details)
                                                        <span class="info-list__text">
                                                            @foreach ($spouseHolder->other_details as $val)
                                                                @if ($val->name == 'Gender')
                                                                    {{ __($val->value) }}
                                                                @endif
                                                            @endforeach
                                                        </span>
                                                    @endif
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="info-wrapper">
                                    <h6 class="info-wrapper__title">
                                        @lang('Nominee Information')
                                    </h6>
                                    <div class="info-card">
                                        <ul class="info-list">
                                            @php
                                                $nomineeHolder = $insuredPlan->policyHolders->where('type', Status::NOMINEE_INFO)->first();
                                            @endphp
                                            <li class="info-list__item">
                                                <span class="info-list__title">
                                                    @lang('Insured')
                                                </span>
                                                <span class="info-list__text">
                                                    {{ $nomineeHolder->name ?? 'N/A' }}
                                                </span>
                                            </li>
                                            <li class="info-list__item">
                                                <span class="info-list__title">
                                                    @lang('NID Number')
                                                </span>
                                                <span class="info-list__text">
                                                    @if ($nomineeHolder->other_details)
                                                        <span class="info-list__text">
                                                            @foreach ($nomineeHolder->other_details as $val)
                                                                @if ($val->name == 'NID')
                                                                    {{ __($val->value) }}
                                                                @endif
                                                            @endforeach
                                                        </span>
                                                    @endif
                                                </span>
                                            </li>
                                            <li class="info-list__item">
                                                <span class="info-list__title">
                                                    @lang('Phone Number')
                                                </span>
                                                @if ($nomineeHolder->other_details)
                                                    <span class="info-list__text">
                                                        @foreach ($nomineeHolder->other_details as $val)
                                                            @if ($val->name == 'Phone Number')
                                                                {{ __($val->value) }}
                                                            @endif
                                                        @endforeach
                                                    </span>
                                                @endif
                                            </li>
                                            <li class="info-list__item">
                                                <span class="info-list__title">
                                                    @lang('Date of Birth')
                                                </span>
                                                <span class="info-list__text">
                                                    {{ $nomineeHolder->date_of_birth ?? 'N/A' }}
                                                </span>
                                            </li>
                                            <li class="info-list__item">
                                                <span class="info-list__title">
                                                    @lang('Gender')
                                                </span>
                                                @if ($nomineeHolder->other_details)
                                                    <span class="info-list__text">
                                                        @foreach ($nomineeHolder->other_details as $val)
                                                            @if ($val->name == 'Gender')
                                                                {{ __($val->value) }}
                                                            @endif
                                                        @endforeach
                                                    </span>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="btn--groups mt-4 d-flex flex-wrap gap-2">
                            <a href="{{ route('user.payment.info',$insuredPlan->id) }}" class="btn btn--base">
                                @lang('Confirm & Payment')
                                <span class="btn-icon">
                                    <i class="las la-angle-right"></i>
                                </span>
                            </a>
                            <a href="{{ route('user.nominee.info', $insuredPlan->id) }}" class="btn btn--white"> @lang('Back') </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
