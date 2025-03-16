<div class="sidebar-menu">
    <div class="sidebar-menu__inner">
        <span class="sidebar-menu__close d-lg-none d-flex"><i class="fas fa-times"></i></span>
        <!-- Sidebar Logo Start -->
        <div class="sidebar-logo">
            <a href="{{ route('home') }}" class="sidebar-logo__link"><img src="{{ siteLogo() }}" alt="logo" /></a>

            <span class="sidebar-menu__bar">
                <i class="las la-bars"></i>
            </span>
            <span class="bar-style"></span>
        </div>
        <!-- Sidebar Logo End -->

        <!-- ========= Sidebar Menu Start ================ -->
        <ul class="sidebar-menu-list">
            <li class="sidebar-menu-list__item {{ menuActive('user.home') }}">
                <a href="{{ route('user.home') }}" class="sidebar-menu-list__link">
                    <span class="icon">
                        <i class="fa-solid fa-border-all"></i>
                    </span>
                    <span class="text"> @lang('Dashboard') </span>
                </a>
            </li>

            <li class="sidebar-menu-list__item has-dropdown {{ menuActive('user.policy*') }}">
                <a href="javascript:void(0)" class="sidebar-menu-list__link">
                    <span class="icon"> <i class="fa-solid fa-user"></i></span>
                    <span class="text"> @lang('My Policies') </span>
                </a>
                <div class="sidebar-submenu">
                    <ul class="sidebar-submenu-list">
                        <li class="sidebar-submenu-list__item {{ menuActive('user.policy.list') }}">
                            <a href="{{ route('user.policy.list') }}" class="sidebar-submenu-list__link">
                                <span class="text"> @lang('All Policies') </span>
                            </a>
                        </li>
                        <li class="sidebar-submenu-list__item">
                            <a href="policy-details.html" class="sidebar-submenu-list__link">
                                <span class="text"> @lang('policy details') </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="sidebar-menu-list__item has-dropdown">
                <a href="javascript:void(0)" class="sidebar-menu-list__link">
                    <span class="icon">
                        <i class="fa-solid fa-file-lines"></i></span>
                    <span class="text"> @lang('Claims Center') </span>
                </a>
                <div class="sidebar-submenu">
                    <ul class="sidebar-submenu-list {{ menuActive('user.claim.insurance*') }}">
                        <li class="sidebar-submenu-list__item {{ menuActive('user.claim.insurance.request', @$claimId) }}">
                            <a href="{{ route('user.claim.insurance.request', @$claimId) }}" class="sidebar-submenu-list__link">
                                <span class="text"> @lang('Claim insurance') </span>
                            </a>
                        </li>
                        <li class="sidebar-submenu-list__item">
                            <a href="" class="sidebar-submenu-list__link">
                                <span class="text"> @lang('policy insurance') </span>
                            </a>
                        </li>
                        <li class="sidebar-submenu-list__item {{ menuActive('user.claim.list', @$claimId) }}">
                            <a href="{{ route('user.claim.list') }}" class="sidebar-submenu-list__link">
                                <span class="text"> @lang('Claim List') </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="sidebar-menu-list__item {{ menuActive('user.insurance.info') }}">
                <a href="{{ route('user.insurance.info') }}" class="sidebar-menu-list__link">
                    <span class="icon">
                        <i class="fa-solid fa-list-check"></i>
                    </span>
                    <span class="text"> @lang('Get a Insurance') </span>
                </a>
            </li>
            <li class="sidebar-menu-list__item">
                <a href="{{ route('user.deposit.index') }}" class="sidebar-menu-list__link">
                    <span class="icon">
                        <i class="las la-money-check-alt"></i>
                    </span>
                    <span class="text"> @lang('Make Deposit') </span>
                </a>
            </li>
            <li class="sidebar-menu-list__item">
                <a href="{{ route('user.withdraw.index') }}" class="sidebar-menu-list__link">
                    <span class="icon">
                        <i class="las la-money-bill"></i>
                    </span>
                    <span class="text"> @lang('Make Withdraw') </span>
                </a>
            </li>
            <li class="sidebar-menu-list__item {{ menuActive('user.setting') }}">
                <a href="{{ route('user.setting') }}" class="sidebar-menu-list__link">
                    <span class="icon"> <i class="fa-solid fa-gear"></i> </span>
                    <span class="text"> @lang('Settings') </span>
                </a>
            </li>
            <li class="sidebar-menu-list__item {{ menuActive('ticket.open') }}">
                <a href="{{ route('ticket.open') }}" class="sidebar-menu-list__link">
                    <span class="icon">
                        <i class="fa-solid fa-circle-question"></i>
                    </span>
                    <span class="text"> @lang('Support') </span>
                </a>
            </li>
        </ul>
    </div>
</div>
