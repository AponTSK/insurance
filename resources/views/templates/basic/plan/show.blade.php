@php
    @$insuranceContent = getContent('insurance_list.content', true);
    @$insuranceElements = getContent('insurance_list.element', false, orderById: true);
    @$quoteContent = getContent('quote.content', true);
@endphp

@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="plan-section py-60">
        <div class="plan-section__shape">
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
            <div class="plan-section__top">
                <div class="insurance-info">
                    <p class="insurance-info__title"> @lang('Insured Info') </p>
                    <p class="insurance-info__text"> {{ $validatedData['your_age'] }} @lang('Yrs'),
                        {{ $validatedData['spouse_age'] ?? 'N/A' }} @lang('Yrs'),
                        {{ isset($validatedData['children_count']) && $validatedData['children_count'] == 1 ? '1 child' : ($validatedData['children_count'] ?? 0) . ' children' }} </p>
                </div>
                <div class="insurance-info">
                    <p class="insurance-info__title"> @lang('Health Coverage Range') </p>
                    <p class="insurance-info__text">
                        @if ($validatedData['coverage_amount'] === 'all')
                            @lang('All Plans')
                        @else
                            @lang('Up to') {{ showAmount($validatedData['coverage_amount']) }}
                        @endif
                    </p>
                </div>
                <div class="insurance-info">
                    <p class="insurance-info__text"> <a href="javascript:void(0);" class="edit-btn "> <i class="las la-pen"></i> </a>
                        @lang('Update Insurance') </p>
                </div>
            </div>
            <div class="plan-container">
                <h3 class="plan-container__title"> {{ __($category->name) }} @lang('Plans') </h3>
                <div class="plan-wrapper">
                    <div class="plan-wrapper__left">
                        @forelse($plans as $plan)
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
                                    <a href="{{ route('detail.plan', $plan->id) }}" class="btn btn--white"> @lang('Buy Now') </a>
                                    <div class="form-check form--check">
                                        <input class="form-check-input" type="checkbox" id="Checkbox{{ $plan->id }}" value="option1">
                                        <label class="form-check-label compare-checkbox" data-id="{{ $plan->id }}" for="Checkbox{{ $plan->id }}"> @lang('Add to Compare') </label>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center">@lang('No plans found matching your criteria.')</p>
                        @endforelse
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

    @include($activeTemplate . 'sections.faq')
    @include($activeTemplate . 'sections.cta')
@endsection


@push('script')
    <script>
        "use strict";

        (function($) {

            $('.back-btn').on('click', function(e) {
                e.preventDefault();
                window.history.back();
            });

            $('.edit-btn').on('click', function(e) {
                e.preventDefault();
                window.history.back();
            });


            localStorage.removeItem("comparePlans");

            let selectedPlans = [];

            function updateButton() {
                $('.compareBtn').prop('disabled', selectedPlans.length < 2);
            }

            $('.compare-checkbox').on('change', function() {
                let planId = $(this).data('id');

                if ($(this).is(':checked')) {
                    if (selectedPlans.length < 3) {
                        selectedPlans.push(planId);
                    } else {
                        alert("You can compare up to 3 plans.");
                        $(this).prop('checked', false);
                    }
                } else {
                    selectedPlans = selectedPlans.filter(id => id !== planId);
                }

                updateButton();
            });

            $('.compareBtn').on('click', function() {
                if (selectedPlans.length < 2) {
                    notify("error", "Please select at least two plans to compare!");
                    return;
                }
                window.location.href = "{{ route('compare.plan') }}?plans=" + selectedPlans.join(',');
            });


            $('.country-code').on('change', function() {
                let selectedOption = $(this).find(':selected');
                $('input[name=mobile_code]').val(selectedOption.data('mobile_code'));
                $('input[name=country_code]').val(selectedOption.val());
            });

            let defaultOption = $('.country-code :selected');
            $('input[name=mobile_code]').val(defaultOption.data('mobile_code'));
            $('input[name=country_code]').val(defaultOption.val());


            updateButton();
        })(jQuery);
    </script>
@endpush
