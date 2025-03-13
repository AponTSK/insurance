@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="dashboard-body">
        <div class="dashboard-tab">
            <x-setting-nav />
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade" id="pills-privacy" role="tabpanel" aria-labelledby="pills-privacy-tab" tabindex="0">
                    <div class="dashboard-body__top">
                        <div class="dashboard-body__left">
                            <h4 class="title mb-0">Notification Preferences</h4>
                        </div>
                    </div>
                    <div class="information-container information-two">
                        <div class="authentication-item">
                            <div class="authentication-item__top">
                                <div>
                                    <h5 class="authentication-item__title">
                                        Enhance Your Security with Two-Factor
                                        Authentication
                                    </h5>
                                    <p class="authentication-item__text">
                                        Add an extra layer of security to your account and
                                        protect your sensitive information.
                                    </p>
                                </div>
                                <div class="form--switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheck4" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xxl-5 col-xl-6 col-sm-10">
                                    <div class="form-group">
                                        <label class="form--label">
                                            Select Authentication Method
                                        </label>
                                        <select class="form-select form--control select2">
                                            <option selected>Select method</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="name-two" class="form--label">
                                            Enter Your Email Address
                                        </label>
                                        <input type="email" class="form--control" placeholder="Cameron Williamson" id="name-two" />
                                    </div>
                                    <div class="form-group">
                                        <label for="code" class="form--label">
                                            Enter Verification Code
                                        </label>
                                        <input type="number" class="form--control" placeholder="0435" id="code" />
                                    </div>
                                    <button class="btn--base btn">Enable 2FA</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
