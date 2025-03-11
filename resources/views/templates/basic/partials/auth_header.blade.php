{{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ siteLogo() }}" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="@lang('Toggle navigation')">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">

                @if (gs('multi_language'))
                    @php
                        $language = App\Models\Language::all();
                    @endphp
                    <select class="langSel form-control">
                        @foreach ($language as $item)
                            <option value="{{ $item->code }}" @if (session('lang') == $item->code) selected @endif>{{ __($item->name) }}</option>
                        @endforeach
                    </select>
                @endif



                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">@lang('contact')</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.login') }}">@lang('login')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.register') }}">@lang('register')</a>
                    </li>
                @endguest
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.home') }}">@lang('Dashboard')</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @lang('Support Ticket')
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('ticket.open') }}">@lang('Create New')</a>
                            <a class="dropdown-item" href="{{ route('ticket.index') }}">@lang('My
                                                                                            Ticket')</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @lang('Deposit')
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('user.deposit.index') }}">@lang('Deposit Money')</a>
                            <a class="dropdown-item" href="{{ route('user.deposit.history') }}">@lang('Deposit
                                                                                            Log')</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @lang('Withdraw')
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('user.withdraw') }}">@lang('Withdraw Money')</a>
                            <a class="dropdown-item" href="{{ route('user.withdraw.history') }}">@lang('Withdraw
                                                                                            Log')</a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.transactions') }}">@lang('Transactions')</a>
                    </li>


                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ auth()->user()->fullname }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('user.profile.setting') }}">
                                @lang('Profile Setting')
                            </a>
                            <a class="dropdown-item" href="{{ route('user.change.password') }}">
                                @lang('Change Password')
                            </a>
                            <a class="dropdown-item" href="{{ route('user.twofactor') }}">
                                @lang('2FA Security')
                            </a>


                            <a class="dropdown-item" href="{{ route('user.logout') }}">
                                @lang('Logout')
                            </a>

                        </div>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav> --}}


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
                        <img src="assets/images/thumbs/b-1.png" alt="" />
                    </div>
                    <div class="user-info__profile">
                        <p class="user-info__name">Orla Flores</p>
                        <span class="user-info__desc">
                            orlaflores@riddleui.com
                            <span class="icon"><i class="fa-solid fa-caret-down"></i></span>
                        </span>
                    </div>
                </div>
            </div>
            <ul class="user-info-dropdown">
                <li class="user-info-dropdown__item">
                    <a class="user-info-dropdown__link" href="#">
                        <span class="icon"><i class="far fa-user"></i></span>
                        <span class="text"> View Profile</span>
                    </a>
                </li>

                <li class="user-info-dropdown__item">
                    <a class="user-info-dropdown__link" href="#">
                        <span class="icon">
                            <i class="fa-brands fa-whatsapp"></i>
                        </span>
                        <span class="text"> Meta Setting </span>
                    </a>
                </li>
                <li class="user-info-dropdown__item">
                    <a class="user-info-dropdown__link" href="#">
                        <span class="icon">
                            <i class="fa-solid fa-shield-halved"></i>
                        </span>
                        <span class="text"> 2FA Setting </span>
                    </a>
                </li>
                <li class="user-info-dropdown__item">
                    <a class="user-info-dropdown__link" href="#">
                        <span class="icon">
                            <i class="fa-solid fa-question"></i>
                        </span>
                        <span class="text"> Support Ticket </span>
                    </a>
                </li>
                <li class="user-info-dropdown__item">
                    <a class="user-info-dropdown__link" href="#">
                        <span class="icon">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        </span>
                        <span class="text"> Sign Out </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
