@php

    $coverageAmountOptions = [];
    $incrementAmount = 5000;
    $limit = 20000;

    for ($i = $incrementAmount; $i <= $limit; $i += $incrementAmount) {
        $coverageAmountOptions[$i] = $i;
    }

@endphp

@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="row col-lg-4">
        <h5 class="card-title">@lang('Health Plan')</h5>
        <div class="user">
            <div class="thumb"><img src="" class="plugin_bg">
            </div>
            <span class="name"></span>
        </div>
        <form action="{{ route('show.plan') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-12">
                    <div class="form--group">
                        <label for="full_name" class="form--label fw-bold">@lang('Your Full Name')</label>
                        <input type="text" class="form-control form-control-lg" id="full_name" name="full_name" placeholder="@lang('Enter your name')" required>
                        <div class="invalid-feedback">@lang('Please enter your full name.')</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form--label fw-bold">@lang('Country')</label>
                        <select name="country" class="form-control form--control select2" required>
                            @foreach ($countries as $key => $country)
                                <option data-mobile_code="{{ $country->dial_code }}" value="{{ $country->country }}" data-code="{{ $key }}">{{ __($country->country) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form--group">
                        <label class="form--label fw-bold">@lang('Mobile')</label>
                        <div class="input-group ">
                            <span class="input-group-text mobile-code">

                            </span>
                            <input type="hidden" name="mobile_code">
                            <input type="hidden" name="country_code">
                            <input type="number" name="mobile" value="{{ old('mobile') }}" class="form-control form--control checkUser" required>
                        </div>
                        <small class="text--danger mobileExist"></small>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form--group">
                        <label for="member_name" class="form--label fw-bold">@lang('Members')</label>
                        <select class="form-select form-select-lg select2" id="member" name="member" required>
                            <option value="">@lang('Select member')</option>
                            <option value="2">@lang('2')</option>
                            <option value="3">@lang('3')</option>
                        </select>
                        <div class="invalid-feedback">@lang('Please select member')</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form--group">
                        <label for="your_age" class="form--label fw-bold">@lang('Your Age')</label>
                        <select class="form-select form-select-lg select2" id="your_age" name="your_age" required>
                            <option value="">@lang('Select your age')</option>
                            <option value="19">@lang('19')</option>
                            <option value="20">@lang('20')</option>
                        </select>
                        <div class="invalid-feedback">@lang('Please select your age.')</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form--group">
                        <label for="spouse_age" class="form--label fw-bold">@lang('Spouse Age')</label>
                        <select class="form-select form-select-lg select2" id="spouse_age" name="spouse_age">
                            <option value="">@lang('Select spouse age')</option>
                            <option value="19">@lang('19')</option>
                            <option value="20">@lang('20')</option>
                        </select>
                        <div class="invalid-feedback">@lang('Please select spouse age.')</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form--group">
                        <label class="form--label fw-bold">@lang('Number of Child (Below 18 years)')</label>
                        <div class="d-flex gap-3">
                            @for ($i = 1; $i <= $maxChildren; $i++)
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="children_{{ $i }}" name="children_count" value="{{ $i }}" required>
                                    <label class="form-check-label" for="children_{{ $i }}">@lang(':count Child', ['count' => $i])</label>
                                </div>
                            @endfor
                        </div>
                        <div class="invalid-feedback">@lang('Please select the number of children.')</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form--group">
                        <label class="form--label fw-bold">@lang('Health Coverage Amount')</label>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="coverage_all" name="coverage_amount" value="all" checked required>
                                <label class="form-check-label" for="coverage_all">@lang('All Plans')</label>
                            </div>
                            @foreach ($coverageAmountOptions as $coverageAmount)
                                <input type="radio" class="form-check-input" id="coverage_{{ $coverageAmount }}" name="coverage_amount" value="{{ $coverageAmount }}" checked required>
                                <label class="form-check-label" for="coverage_{{ $coverageAmount }}">@lang('Up to :coverage', ['coverage' => number_format($coverageAmount)])</label>
                            @endforeach
                        </div>
                        <div class="invalid-feedback">@lang('Please select a coverage amount.')</div>
                    </div>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary w-100 py-3 fw-bold">@lang('See Plans')</button>
                </div>
            </div>
        </form>
    </div>
@endsection



@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/global/css/select2.min.css') }}">
@endpush

@push('script-lib')
    <script src="{{ asset('assets/global/js/select2.min.js') }}"></script>
@endpush


@push('script')
    <script>
        "use strict";
        (function($) {

            @if ($mobileCode)
                $(`option[data-code={{ $mobileCode }}]`).attr('selected', '');
            @endif

            $('.select2').select2();

            $('select[name=country]').on('change', function() {
                $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
                $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
                $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
                var value = $('[name=mobile]').val();
                var name = 'mobile';
                checkUser(value, name);
            });

            $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
            $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
            $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));


            $('.checkUser').on('focusout', function(e) {
                var value = $(this).val();
                var name = $(this).attr('name')
                checkUser(value, name);
            });

            function checkUser(value, name) {
                var url = '{{ route('user.checkUser') }}';
                var token = '{{ csrf_token() }}';

                if (name == 'mobile') {
                    var mobile = `${value}`;
                    var data = {
                        mobile: mobile,
                        mobile_code: $('.mobile-code').text().substr(1),
                        _token: token
                    }
                }
                if (name == 'username') {
                    var data = {
                        username: value,
                        _token: token
                    }
                }
                $.post(url, data, function(response) {
                    if (response.data != false) {
                        $(`.${response.type}Exist`).text(`${response.field} already exist`);
                    } else {
                        $(`.${response.type}Exist`).text('');
                    }
                });
            }
        })(jQuery);
    </script>
@endpush
