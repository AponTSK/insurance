<ul class="page-list">
    <li class="nav-item @if (request()->routeIs(['user.claim.insurance.request', 'user.claim.insurance.accident.details','user.claim.insurance.details.review'])) active @endif">
        <a class="nav-link" href="{{ route('user.claim.insurance.request',$claimId) }}">
            <span class="nav-link__title"> @lang('Policy Holder Information') </span>
        </a>
    </li>
    <li class="nav-item @if (request()->routeIs('user.claim.insurance.accident.details','user.claim.insurance.details.review')) active @endif">
        <a class="nav-link" href="{{ route('user.claim.insurance.accident.details', @$claimId) }}">
            <span class="nav-link__title"> @lang('Accident Details') </span>
        </a>
    </li>
    <li class="nav-item @if (request()->routeIs('user.claim.insurance.details.review')) active @endif">
        <a class="nav-link" href="{{ route('user.claim.insurance.details.review', @$claimId) }}">
            <span class="nav-link__title"> @lang('Submit Details') </span>
        </a>
    </li>
</ul>
