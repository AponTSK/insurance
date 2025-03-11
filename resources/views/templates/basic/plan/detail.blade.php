@php
    @$insuranceContent = getContent('insurance_list.content', true);
    @$insuranceElements = getContent('insurance_list.element', false, orderById: true);
    @$quoteContent = getContent('quote.content', true);
@endphp

@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="plan-details-section py-60">
        <div class="plan-details-section__shape">
            <img src="{{ frontendImage('insurance_list', $insuranceContent->data_values->background_shape) }}" alt="image">
        </div>
        <div class="container">
            <div class="plan-section__btn">
                <a href="javascript:void(0);" class="back-btn">
                    <span class="back-btn__icon">
                        <i class="las la-arrow-left"></i>
                    </span> @lang('Back')
                </a>
            </div>

            <div class="plan-container">
                <div class="plan-wrapper">
                    <div class="plan-wrapper__left">
                        <div class="plan-item">
                            <div class="plan-item__content">
                                <p class="plan-item__title"> @lang('Health Coverage') </p>
                                <h6 class="plan-item__number">{{ showAmount($plan->price) }}</h6>
                                <div class="plan-item__bottom">
                                    <p class="plan-item__desc"> <span class="icon"> <i class="fa-solid fa-circle-info"></i> </span> @lang('Family Floater Plan') </p>
                                </div>
                            </div>
                            <div class="plan-item__content">
                                <p class="plan-item__title"> @lang('Premium') </p>
                                <h6 class="plan-item__number"> {{ showAmount($plan->price) }} </h6>
                                <div class="plan-item__bottom">
                                    <p class="plan-item__desc"> @lang('Policy Duration:') {{ $plan->validity }} @lang('Year') </p>
                                    <p class="plan-item__desc"> @lang('Total Sum Insured') {{ showAmount($plan->coverage_amount) }} </p>
                                </div>
                            </div>

                            <div class="plan-item__content flex-align gap-2">
                                <span class="plan-item__icon">
                                    <img src="{{ frontendImage('insurance_list', @$insuranceContent->data_values->feature_image) }}" alt="image">
                                </span>
                                <div class="plan-item__bottom">
                                    <span class="text"> @lang('Special Features:') </span>
                                    <p class="plan-item__desc"> @lang('Policy Duration:') {{ $plan->validity }} @lang('Year') </p>
                                    <p class="plan-item__desc"> @lang('Total Sum Insured') {{ showAmount($plan->coverage_amount) }} </p>
                                </div>
                            </div>
                            <div class="plan-item__content">
                                <button class="btn btn--white"> @lang('Buy Now') </button>
                            </div>
                        </div>
                        <div class="plan-details__item">
                            <h3 class="plan-details__title"> {{ __($insuranceContent->data_values->cover_title) }} </h3>
                            <div class="content-list-wrapper">
                                @forelse ($plan->notCovers as $notCover)
                                    <div class="form-check form--check">
                                        <input class="form-check-input" type="checkbox" id="Checkbox1" value="option1">
                                        <label class="form-check-label" for="Checkbox1"> {{ __($notCover->title) }} </label>
                                    </div>
                                @empty
                                    <li>@lang('Nothing available for this plan.')</li>
                                @endforelse
                            </div>
                        </div>
                        <div class="plan-details__item">
                            <h3 class="plan-details__title"> {{ __($insuranceContent->data_values->feature_title) }} </h3>
                            <div class="feature-list">
                                @forelse ($plan->features as $feature)
                                    <div class="feature-item">
                                        <span class="feature-item__icon">
                                            <img src="{{ getImage(getFilePath('featureImage') . '/' . $feature->image, getFileSize('featureImage')) }}" alt="image">
                                        </span>
                                        <p class="feature-item__text">{{ __($feature->title) }} </p>
                                        <h6 class="feature-item__title"> {{ __($feature->subtitle) }} </h6>
                                    </div>
                                @empty
                                    <li>@lang('No features available for this plan.')</li>
                                @endforelse

                            </div>
                        </div>
                    </div>
                    <div class="plan-wrapper__right">
                        <div class="plan-sidebar">
                            <div class="plan-sidebar__top">
                                <div class="plan-sidebar__top-left">
                                    <h6 class="plan-sidebar__title">
                                        @lang('Tips for selecting the best plan')
                                    </h6>
                                </div>
                                <span class="icon">
                                    <img src="{{ frontendImage('insurance_list', @$insuranceContent->data_values->plan_image_one) }}" alt="image">
                                </span>
                            </div>
                            <ul class="plan-list">
                                @foreach ($insuranceElements as $insuranceElement)
                                    <li class="plan-list__item">
                                        <span class="plan-list__icon"> <i class="fa-regular fa-circle-question"></i> </span>
                                        <div class="plan-list__content">
                                            @php
                                                echo $insuranceElement->data_values->plan_tips;
                                            @endphp
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="plan-sidebar">
                            <div class="plan-sidebar__top">
                                <div class="plan-sidebar__top-left">
                                    <h6 class="plan-sidebar__title">
                                        @lang('Need more help?')
                                    </h6>
                                    <p class="plan-sidebar__text"> @lang('We are always here to assist you!') </p>
                                </div>
                                <span class="icon">
                                    <img src="{{ frontendImage('insurance_list', @$insuranceContent->data_values->plan_image_two) }}" alt="image">
                                </span>
                            </div>
                            <form action="{{ route('quote.update') }}" method="POST" class="plan-form">
                                @csrf
                                <div class="row gy-3">
                                    <div class="col-sm-12">
                                        <label class="form--label"> @lang('Select Your Topic') </label>
                                        <select class="form-select form--control select2" name="topic_id" required>
                                            <@foreach ($quoteTopics as $quoteTopic)
                                                <option value="{{ $quoteTopic->id }}">{{ $quoteTopic->topic }}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-12">
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
                                            <input type="text" class="form-control form--control phone-number" name="mobile" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn--base w-100"> @lang('Submit Now') </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include($activeTemplate . 'sections.cta')
@endsection


@push('style-lib')
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/select2.min.css') }}">
@endpush

@push('script-lib')
    <script src="{{ asset($activeTemplateTrue . 'js/select2.min.js') }}"></script>
@endpush


@push('script')
    <script>
        "use strict";

        (function($) {

            $('.back-btn').on('click', function(e) {
                e.preventDefault();
                window.history.back();
            });

        })(jQuery);
    </script>
@endpush

@push('script')
    <script>
        "use strict";
        (function($) {
            $('.country-code').on('change', function() {
                let selectedOption = $(this).find(':selected');
                $('input[name=mobile_code]').val(selectedOption.data('mobile_code'));
                $('input[name=country_code]').val(selectedOption.val());
            });

            let defaultOption = $('.country-code :selected');
            $('input[name=mobile_code]').val(defaultOption.data('mobile_code'));
            $('input[name=country_code]').val(defaultOption.val());
        })(jQuery);
    </script>
@endpush
