<div class="insurance-plan-wrapper__header">
    <h4 class="title">@lang('Secure Your Future with the Right Insurance Plan')</h4>
    <p class="text">@lang('Customize your coverage and get insured in just a few easy steps!')</p>
    <div class="insurance-plan-wrapper__shape">
        <img src="{{ asset($activeTemplateTrue . 'images/ds-2.png') }}" alt="image">
    </div>
</div>
<div class="plan-info">
    @php
        $insuredPlan = App\Models\InsuredPlan::where('user_id', auth()->id())
            ->where('payment_status', \App\Constants\Status::PAYMENT_INITIATE)
            ->where('id', $insuredPlanId)
            ->first();

        use App\Constants\Status;
        $steps = [
            Status::INSURANCE_STEP => 1,
            Status::YOUR_INFO_STEP => 2,
            Status::SPOUSE_STEP => 3,
            Status::NOMINEE_STEP => 4,
            Status::DECLARATION_STEP => 5,
            Status::PAYMENT_STEP => 6,
        ];

        $currentStep = $insuredPlan && isset($steps[$insuredPlan->step]) ? $steps[$insuredPlan->step] : 1;

        $currentRoute = request()->route()->getName();
    @endphp

    @if (!$insuredPlan && $currentRoute !== 'user.insurance.info')
        <div class="alert alert-danger">@lang('Please start the insurance process first.')</div>
    @endif

    <ul class="page-list">
        <li
            class="nav-item {{ $currentRoute === 'user.insurance.info' || $currentRoute === 'user.info' || $currentRoute === 'user.spouse.info' || $currentRoute === 'user.nominee.info' || $currentRoute === 'user.declaration' || $currentRoute === 'user.payment' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.insurance.info') }}">
                <span class="nav-link__title"> @lang('Insurance Information') </span>
            </a>
        </li>

        <li
            class="nav-item {{ $currentRoute === 'user.info' || $currentRoute === 'user.spouse.info' || $currentRoute === 'user.nominee.info' || $currentRoute === 'user.declaration' || $currentRoute === 'user.payment' ? 'active' : '' }}">
            @if ($currentStep >= 2)
                <a class="nav-link" href="{{ route('user.info', $insuredPlanId) }}">
                    <span class="nav-link__title"> @lang('Your Information') </span>
                </a>
            @else
                <span class="nav-link disabled">
                    <span class="nav-link__title"> @lang('Your Information') </span>
                </span>
            @endif
        </li>

        <li class="nav-item {{ $currentRoute === 'user.spouse.info' || $currentRoute === 'user.nominee.info' || $currentRoute === 'user.declaration' || $currentRoute === 'user.payment' ? 'active' : '' }}">
            @if ($currentStep >= 3)
                <a class="nav-link" href="{{ route('user.spouse.info', $insuredPlanId) }}">
                    <span class="nav-link__title"> @lang('Spouse Information') </span>
                </a>
            @else
                <span class="nav-link disabled">
                    <span class="nav-link__title"> @lang('Spouse Information') </span>
                </span>
            @endif
        </li>

        <li class="nav-item {{ $currentRoute === 'user.nominee.info' || $currentRoute === 'user.declaration' || $currentRoute === 'user.payment' ? 'active' : '' }}">
            @if ($currentStep >= 4)
                <a class="nav-link" href="{{ route('user.nominee.info', $insuredPlanId) }}">
                    <span class="nav-link__title"> @lang('Nominee Information') </span>
                </a>
            @else
                <span class="nav-link disabled">
                    <span class="nav-link__title"> @lang('Nominee Information') </span>
                </span>
            @endif
        </li>

        <li class="nav-item {{ $currentRoute === 'user.declaration' || $currentRoute === 'user.payment' ? 'active' : '' }}">
            @if ($currentStep >= 5)
                <a class="nav-link" href="{{ route('user.declaration', $insuredPlanId) }}">
                    <span class="nav-link__title"> @lang('Declaration') </span>
                </a>
            @else
                <span class="nav-link disabled">
                    <span class="nav-link__title"> @lang('Declaration') </span>
                </span>
            @endif
        </li>

        <li class="nav-item {{ $currentRoute === 'user.payment' ? 'active' : '' }}">
            @if ($currentStep >= 6)
                <a class="nav-link" href="{{ route('user.payment', $insuredPlanId) }}">
                    <span class="nav-link__title"> @lang('Payment') </span>
                </a>
            @else
                <span class="nav-link disabled">
                    <span class="nav-link__title"> @lang('Payment') </span>
                </span>
            @endif
        </li>
    </ul>
</div>
