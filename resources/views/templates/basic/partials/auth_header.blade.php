<div class="dashboard-header">
    <div class="dashboard-header__inner d-flex justify-content-between">
        <div class="dashboard-header__left">
            <div class="dashboard-body__bar d-lg-none d-block">
                <span class="dashboard-body__bar-icon"><i class="fas fa-bars"></i></span>
            </div>
            <form action="#" class="search-form">
                <span class="search-form__icon">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input type="text" class="form--control" placeholder="Search policies, claims, or FAQs" />
            </form>
        </div>
        <div class="user-info">
            <div class="user-info__right">
                <div class="user-info__button">
                    <div class="user-info__thumb">
                        <img class="fit-image" src="{{ getImage(getFilePath('userProfile') . '/' . auth()->user()->image) }}" alt="profile" />
                    </div>
                    <div class="user-info__profile">
                        <p class="user-info__name">{{ auth()->user()->fullname }}</p>
                        <span class="user-info__desc">
                            {{ auth()->user()->email }}
                            <span class="icon"><i class="fa-solid fa-caret-down"></i></span>
                        </span>
                    </div>
                </div>
            </div>
            <ul class="user-info-dropdown">
                <li class="user-info-dropdown__item">
                    <a class="user-info-dropdown__link" href="{{ route('user.profile.setting') }}">
                        <span class="icon"><i class="far fa-user"></i></span>
                        <span class="text"> @lang('View Profile')</span>
                    </a>
                </li>

                <li class="user-info-dropdown__item">
                    <a class="user-info-dropdown__link" href="#">
                        <span class="icon">
                            <i class="fa-brands fa-whatsapp"></i>
                        </span>
                        <span class="text"> @lang('Meta Setting') </span>
                    </a>
                </li>
                <li class="user-info-dropdown__item">
                    <a class="user-info-dropdown__link" href="{{ route('user.twofactor') }}">
                        <span class="icon">
                            <i class="fa-solid fa-shield-halved"></i>
                        </span>
                        <span class="text"> @lang('2FA Setting') </span>
                    </a>
                </li>
                <li class="user-info-dropdown__item">
                    <a class="user-info-dropdown__link" href="{{ route('ticket.open') }}">
                        <span class="icon">
                            <i class="fa-solid fa-question"></i>
                        </span>
                        <span class="text"> @lang('Support Ticket') </span>
                    </a>
                </li>
                <li class="user-info-dropdown__item">
                    <a class="user-info-dropdown__link" href="{{ route('user.logout') }}">
                        <span class="icon">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        </span>
                        <span class="text"> @lang('Sign Out') </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
