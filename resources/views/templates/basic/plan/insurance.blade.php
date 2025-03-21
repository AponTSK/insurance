@php
    @$insuranceContent = getContent('health_insurance.content', true);
    $coverageAmountOptions = [];
    $incrementAmount = 5000;
    $limit = 20000;
    $ageRange = range(18, 70);
    for ($i = $incrementAmount; $i <= $limit; $i += $incrementAmount) {
        $coverageAmountOptions[$i] = $i;
    }
@endphp

@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="insurance-section py-60">
        <div class="banner-section__shape">
            <img src="{{ asset($activeTemplateTrue . 'images/bs-1.png') }}" alt="image">
        </div>
        <div class="container">
            <div class="section-heading">
                <h2 class="section-heading__title">{{ __($category->name) }}</h2>
                <p class="section-heading__desc">@lang('Choose the best :category Plan', ['category' => $category->name])</p>

            </div>
            <form action="{{ route('show.plan') }}" method="get">
                <input type="hidden" name="category_id" value="{{ $category->id }}">
                <div class="row gy-4">
                    <div class="col-lg-6">
                        <div class="insurance-thumb">
                            <img src="{{ frontendImage('health_insurance', $insuranceContent->data_values->image, '515x580') }}" alt="image" />
                            {{-- <img src="{{ getImage(getFilePath('categoryImage') . '/' . $category->image, getFileSize('categoryImage')) }}" alt="image"> --}}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row gy-4">
                            <div class="col-lg-6">
                                <label class="form--label">@lang('Your Full Name')</label>
                                <input type="text" class="form--control" placeholder="@lang('Enter your name')" name="full_name" required />
                            </div>

                            <div class="col-lg-6">
                                <label class="form--label"> @lang('Phone Number') </label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <select class="form-select form--control country-code">
                                            @foreach ($countries as $key => $country)
                                                <option data-mobile_code="{{ $country->dial_code }}" value="{{ $key }}">
                                                    +{{ $country->dial_code }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <input type="hidden" name="mobile_code">
                                    <input type="hidden" name="country_code">
                                    <input type="number" value="{{ old('mobile') }}" class="form-control form--control checkUser" name="mobile" required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label class="form--label">@lang('Your Age')</label>
                                <select class="form-select form--control select2" name="your_age" required>
                                    <option value="">@lang('Select your age')</option>
                                    @foreach ($ageRange as $age)
                                        <option value="{{ $age }}">{{ $age }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label class="form--label">@lang('Spouse Age')</label>
                                <select class="form-select form--control select2" name="spouse_age">
                                    <option value="">@lang('Select spouse age')</option>
                                    @foreach ($ageRange as $age)
                                        <option value="{{ $age }}">{{ $age }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($maxChildren > 0)
                                <div class="col-sm-12">
                                    <label class="form--label">@lang('Number of Children (Below 18 years)')</label>
                                    <div class="check-wrapper">
                                        @for ($i = 1; $i <= $maxChildren; $i++)
                                            <label class="type--check" for="child_{{ $i }}">
                                                <input class="d-none" type="radio" id="child_{{ $i }}" name="children_count" value="{{ $i }}" />
                                                <span class="type-text">@lang(':count Child', ['count' => $i])</span>
                                            </label>
                                        @endfor
                                    </div>
                                </div>
                            @endif
                            <div class="col-sm-12">
                                <label class="form--label">@lang('Health Coverage Amount')</label>
                                <div class="check-wrapper">
                                    <label class="type--check" for="coverage_all">
                                        <input class="d-none" type="radio" id="coverage_all" name="coverage_amount" value="all" checked required />
                                        <span class="type-text">@lang('All Plans')</span>
                                    </label>
                                    @foreach ($coverageAmountOptions as $coverageAmount)
                                        <label class="type--check" for="coverage_{{ $coverageAmount }}">
                                            <input class="d-none" type="radio" id="coverage_{{ $coverageAmount }}" name="coverage_amount" value="{{ $coverageAmount }}" required />
                                            <span class="type-text">@lang('Up to :coverage', ['coverage' => number_format($coverageAmount)])</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn--base btn--lg w-100">@lang('See Plans')</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @include($activeTemplate . 'sections.faq')
@endsection

@push('script')
    <script>
        "use strict";
        (function($) {
            $('.select2').select2();
            $('select[name=country]').on('change', function() {
                $('input[name=mobile_code]').val($(this).find(':selected').data('mobile_code'));
                $('input[name=country_code]').val($(this).find(':selected').data('code'));
                $('.mobile-code').text('+' + $(this).find(':selected').data('mobile_code'));
            });
            $('.checkUser').on('focusout', function() {
                let value = $(this).val();
                let url = '{{ route('user.checkUser') }}';
                let token = '{{ csrf_token() }}';
                let data = {
                    mobile: value,
                    mobile_code: $('.mobile-code').text().substr(1),
                    _token: token
                };
                $.post(url, data, function(response) {
                    $('.mobileExist').text(response.data ? `${response.field} already exist` : '');
                });
            });
        })(jQuery);
    </script>
@endpush
