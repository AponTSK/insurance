<div class="insurance-plan-wrapper__header">
    <h4 class="title">@lang('Secure Your Future with the Right Insurance Plan')</h4>
    <p class="text">@lang('Customize your coverage and get insured in just a few easy steps!')</p>
    <div class="insurance-plan-wrapper__shape">
        <img src="{{ asset($activeTemplateTrue . 'images/ds-2.png') }}" alt="image">
    </div>
</div>
<div class="plan-info">
    <ul class="page-list">
        <li
            class="nav-item {{ request()->routeIs('user.insurance.info') || request()->routeIs('user.info') || request()->routeIs('user.spouse.info') || request()->routeIs('user.nominee.info') || request()->routeIs('user.declaration') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.insurance.info') }}">
                <span class="nav-link__title"> @lang('Insurance Information') </span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('user.info') || request()->routeIs('user.spouse.info') || request()->routeIs('user.nominee.info') || request()->routeIs('user.declaration') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.info') }}">
                <span class="nav-link__title"> @lang('Your Information') </span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('user.spouse.info') || request()->routeIs('user.nominee.info') || request()->routeIs('user.declaration') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.spouse.info') }}">
                <span class="nav-link__title"> @lang('Spouse Information') </span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('user.nominee.info') || request()->routeIs('user.declaration') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.nominee.info') }}">
                <span class="nav-link__title"> @lang('Nominee Information')</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('user.declaration') ? 'active' : '' }}">
            <a class="nav-link" href="{{ request()->routeIs('user.declaration') }}">
                <span class="nav-link__title"> @lang('Declaration') </span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <span class="nav-link__title"> @lang('Payment') </span>
            </a>
        </li>
    </ul>
</div>
