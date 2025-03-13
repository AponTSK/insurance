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
            <li class="sidebar-menu-list__item">
                <a href="{{ route('user.home') }}" class="sidebar-menu-list__link">
                    <span class="icon">
                        <i class="fa-solid fa-border-all"></i>
                    </span>
                    <span class="text"> @lang('Dashboard') </span>
                </a>
            </li>

            <li class="sidebar-menu-list__item has-dropdown">
                <a href="#" class="sidebar-menu-list__link">
                    <span class="icon">
                        <i class="fa-solid fa-bars-progress"></i>
                    </span>
                    <span class="text"> @lang('Inbox') </span>
                </a>
                <div class="sidebar-submenu">
                    <ul class="sidebar-submenu-list">
                        <li class="sidebar-submenu-list__item">
                            <a href="inbox.html" class="sidebar-submenu-list__link">
                                <span class="text"> Inbox </span>
                            </a>
                        </li>
                        <li class="sidebar-submenu-list__item">
                            <a href="#" class="sidebar-submenu-list__link">
                                <span class="text"> Inbox </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="sidebar-menu-list__item has-dropdown">
                <a href="javascript:void(0)" class="sidebar-menu-list__link">
                    <span class="icon"> <i class="fa-solid fa-user"></i></span>
                    <span class="text"> @lang('My Policies') </span>
                </a>
                <div class="sidebar-submenu">
                    <ul class="sidebar-submenu-list">
                        <li class="sidebar-submenu-list__item">
                            <a href="dashboard-policy.html" class="sidebar-submenu-list__link">
                                <span class="text"> @lang('policy one') </span>
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
                    <ul class="sidebar-submenu-list">
                        <li class="sidebar-submenu-list__item">
                            <a href="claim-insurance.html" class="sidebar-submenu-list__link">
                                <span class="text"> @lang('Claim insurance') </span>
                            </a>
                        </li>
                        <li class="sidebar-submenu-list__item">
                            <a href="policy-insurance.html" class="sidebar-submenu-list__link">
                                <span class="text"> @lang('policy insurance') </span>
                            </a>
                        </li>
                        <li class="sidebar-submenu-list__item">
                            <a href="claim-details.html" class="sidebar-submenu-list__link">
                                <span class="text"> @lang('Claim details') </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="sidebar-menu-list__item">
                <a href="{{ route('user.insurance.info') }}" class="sidebar-menu-list__link">
                    <span class="icon">
                        <i class="fa-solid fa-list-check"></i>
                    </span>
                    <span class="text"> @lang('Get a Insurance') </span>
                </a>
            </li>
            <li class="sidebar-menu-list__item">
                <a href="{{ route('user.setting') }}" class="sidebar-menu-list__link">
                    <span class="icon"> <i class="fa-solid fa-gear"></i> </span>
                    <span class="text"> @lang('Settings') </span>
                </a>
            </li>
            <li class="sidebar-menu-list__item">
                <a href="{{ route('ticket.open') }}" class="sidebar-menu-list__link">
                    <span class="icon">
                        <i class="fa-solid fa-circle-question"></i>
                    </span>
                    <span class="text"> @lang('Support') </span>
                </a>
            </li>
        </ul>
        <!-- ========= Sidebar Menu End ================ -->
    </div>
</div>
