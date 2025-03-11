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
                <a href="dashboard.html" class="sidebar-menu-list__link">
                    <span class="icon">
                        <i class="fa-solid fa-border-all"></i>
                    </span>
                    <span class="text"> Dashboard </span>
                </a>
            </li>

            <li class="sidebar-menu-list__item has-dropdown">
                <a href="#" class="sidebar-menu-list__link">
                    <span class="icon">
                        <i class="fa-solid fa-bars-progress"></i>
                    </span>
                    <span class="text"> Inbox </span>
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
                    <span class="text"> My Policies </span>
                </a>
                <div class="sidebar-submenu">
                    <ul class="sidebar-submenu-list">
                        <li class="sidebar-submenu-list__item">
                            <a href="dashboard-policy.html" class="sidebar-submenu-list__link">
                                <span class="text"> policy one </span>
                            </a>
                        </li>
                        <li class="sidebar-submenu-list__item">
                            <a href="policy-details.html" class="sidebar-submenu-list__link">
                                <span class="text"> policy details </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="sidebar-menu-list__item has-dropdown">
                <a href="javascript:void(0)" class="sidebar-menu-list__link">
                    <span class="icon">
                        <i class="fa-solid fa-file-lines"></i></span>
                    <span class="text"> Claims Center </span>
                </a>
                <div class="sidebar-submenu">
                    <ul class="sidebar-submenu-list">
                        <li class="sidebar-submenu-list__item">
                            <a href="claim-insurance.html" class="sidebar-submenu-list__link">
                                <span class="text"> Claim insurance </span>
                            </a>
                        </li>
                        <li class="sidebar-submenu-list__item">
                            <a href="policy-insurance.html" class="sidebar-submenu-list__link">
                                <span class="text"> policy insurance </span>
                            </a>
                        </li>
                        <li class="sidebar-submenu-list__item">
                            <a href="claim-details.html" class="sidebar-submenu-list__link">
                                <span class="text"> Claim details </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="sidebar-menu-list__item">
                <a href="insurance-plan.html" class="sidebar-menu-list__link">
                    <span class="icon">
                        <i class="fa-solid fa-list-check"></i>
                    </span>
                    <span class="text"> Get a Insurance </span>
                </a>
            </li>
            <li class="sidebar-menu-list__item">
                <a href="setting.html" class="sidebar-menu-list__link">
                    <span class="icon"> <i class="fa-solid fa-gear"></i> </span>
                    <span class="text"> Settings </span>
                </a>
            </li>
            <li class="sidebar-menu-list__item">
                <a href="#" class="sidebar-menu-list__link">
                    <span class="icon">
                        <i class="fa-solid fa-circle-question"></i>
                    </span>
                    <span class="text"> Support </span>
                </a>
            </li>
        </ul>
        <!-- ========= Sidebar Menu End ================ -->
    </div>
</div>
