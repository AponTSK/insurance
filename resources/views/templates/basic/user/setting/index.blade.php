@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="dashboard-body">
        <div class="dashboard-tab">
            <x-setting-nav />
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                    <div class="dashboard-body__top">
                        <div class="dashboard-body__left">
                            <h4 class="title mb-0">@lang('Your Account Details')</h4>
                        </div>
                        <div class="dashboard-body__right">
                            <button class="btn btn--white">@lang('Discard Changes')</button>
                            <button class="btn btn--base">@lang('Save Changes')</button>
                        </div>
                    </div>
                    <div class="information-container information-two">
                        <div class="row">
                            <div class="col-xl-9">
                                <form action="#">
                                    <div class="row gy-4">
                                        <div class="col-sm-6">
                                            <label for="name" class="form--label">
                                                @lang('Your Name')
                                            </label>
                                            <input type="text" class="form--control" placeholder="Cameron Williamson" id="name" readonly value="{{ old('name', @$user->fullname) }}" />
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="date" class="form--label">
                                                @lang('Date of Birth')
                                            </label>
                                            <input type="date" class="form--control" id="date" />
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form--label"> @lang('Gender') </label>
                                            <select class="form-select form--control select2">
                                                <option selected>@lang('Select One')</option>
                                                <option value="1">@lang('Male')</option>
                                                <option value="2">@lang('Female')</option>
                                                <option value="3">@lang('Other')</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="nid" class="form--label">
                                                @lang('Identification Number (NID)')
                                            </label>
                                            <input type="number" class="form--control" placeholder="254879635825" id="nid" />
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form--label label-two">
                                                @lang('Phone Number')
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <select class="form-select form--control">
                                                        <option selected="">US</option>
                                                        <option value="1">One</option>
                                                        <option value="2">Two</option>
                                                        <option value="3">Three</option>
                                                    </select>
                                                </div>
                                                <input type="text" class="form-control form--control" placeholder="+1 (555) 000-0000" value="{{ old('mobile', @$user->mobile) }}" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="mail" class="form--label">
                                                @lang('Email Address')
                                            </label>
                                            <input type="email" class="form--control" placeholder="olivia@untitledui.com" value="{{ old('email', @$user->email) }}" id="mail" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
