@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="dashboard-body">
        <div class="insurance-plan-wrapper">
            {{-- <x-plan-info insuredPlanId="{{ $insuredPlan->id }}" /> --}}

            <div class="insurance-plan-wrapper__body">
                <div class="row justify-content-center">
                    <div class="col-xxl-8">
                        <div class="payment-card">
                            <div class="payment-card__header">
                                <h5 class="payment-card__title"> @lang('Payment Methods') </h5>
                                <p class="payment-card__text d-flex flex-wrap gap-2"> <span class="icon"> <i class="fa-solid fa-square-check"></i> </span> @lang('Your payment information is safe with us')</p>
                            </div>
                            <form action="{{ route('user.deposit.insert', $insuredPlan->id) }}" method="post" class="deposit-form">
                                @csrf
                                <div class="payment-card__body">
                                    <input type="hidden" name="currency">
                                    <div class="row gy-4">
                                        <div class="col-sm-12">
                                            <label class="form--label fs-18 text--base ">@lang('Select Your Payment Gateway') </label>
                                            <select class="form-select form--control img-select2 select2 gateway-input" name="gateway">
                                                @foreach ($gatewayCurrency as $data)
                                                    <option value='{{ $data->method_code }}' data-gateway='@json($data)' data-min-amount="{{ showAmount($data->min_amount) }}"
                                                        data-max-amount="{{ showAmount($data->max_amount) }}" data-src="{{ getImage(getFilePath('gateway') . '/' . $data->method->image) }}">
                                                        {{ __($data->name) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-12">
                                            <label class="form--label  fs-18 text--base"> @lang('Select Your Amount ')</label>
                                            <div class="input-group">
                                                <input type="number" class="form--control form-control  amount" name="amount" value="{{ getAmount($insuredPlan->coverage) }}" placeholder="1,000.00" readonly>
                                                <span class="input-group-text">{{ gs('cur_text') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <ul class="amount-list">
                                                <li class="amount-list__item">
                                                    <span> @lang('Limit') </span>
                                                    <span class="gateway-limit">@lang('0.00')</span>
                                                </li>
                                                <li class="amount-list__item">
                                                    <span> @lang('Processing Charge') </span>
                                                    <span class="processing-fee">@lang('0.00')</span><span>{{ __(gs('cur_text')) }}</span>
                                                </li>
                                                <li class="amount-list__item total">
                                                    <span> @lang('Total') </span>
                                                    <span class="final-amount">@lang('0.00')</span><span>{{ __(gs('cur_text')) }}</span>
                                                </li>

                                                <li class="gateway-conversion amount-list__item d-none ">
                                                    <span> @lang('Conversion')</span>
                                                    <div class="deposit-info__input">
                                                        <p class="text"></p>
                                                    </div>
                                                </li>

                                                <li class="conversion-currency amount-list__item d-none">
                                                    @lang('In') <span class="gateway-currency"></span>
                                                    <div class="deposit-info__input">
                                                        <p class="text">
                                                            <span class="in-currency"></span>
                                                        </p>
                                                    </div>
                                                </li>
                                                <li class="d-none crypto-message mb-3">
                                                    @lang('Conversion with') <span class="gateway-currency"></span>
                                                    @lang('and final value will Show on next step')
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-12">
                                            <button class="btn btn--base w-100"> @lang('Confirm Payment') </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection


@push('css-lib')
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/img-uploader.main.css') }}">
@endpush
@push('script-lib')
    <script src="{{ asset($activeTemplateTrue . 'js/img-uploader.main.js') }}"></script>
@endpush


@push('style')
    <style>
        .img-flag-inner img {
            max-height: 20px !important;
        }
    </style>
@endpush

@push('script')
    <script>
        "use strict";
        (function($) {

            var amount = parseFloat($('.amount').val() || 0);
            var gateway, minAmount, maxAmount;


            $('.amount').on('input', function(e) {
                amount = parseFloat($(this).val());
                if (!amount) {
                    amount = 0;
                }
                calculation();
            });

            $('.gateway-input').on('change', function(e) {
                gatewayChange();
            });

            function gatewayChange() {
                let gatewayElement = $('.gateway-input option:selected');



                let methodCode = gatewayElement.val();

                gateway = gatewayElement.data('gateway');
                minAmount = gatewayElement.data('min-amount');
                maxAmount = gatewayElement.data('max-amount');

                let processingFeeInfo =
                    `${parseFloat(gateway.percent_charge).toFixed(2)}% with ${parseFloat(gateway.fixed_charge).toFixed(2)} {{ __(gs('cur_text')) }} charge for payment gateway processing fees`
                $(".proccessing-fee-info").attr("data-bs-original-title", processingFeeInfo);
                calculation();
            }

            gatewayChange();

            $(".more-gateway-option").on("click", function(e) {
                let paymentList = $(".gateway-option-list");
                paymentList.find(".gateway-option").removeClass("d-none");
                $(this).addClass('d-none');
                paymentList.animate({
                    scrollTop: (paymentList.height() - 60)
                }, 'slow');
            });

            function calculation() {
                if (!gateway) return;
                $(".gateway-limit").text(minAmount + " - " + maxAmount);

                let percentCharge = 0;
                let fixedCharge = 0;
                let totalPercentCharge = 0;

                if (amount) {
                    percentCharge = parseFloat(gateway.percent_charge);
                    fixedCharge = parseFloat(gateway.fixed_charge);
                    totalPercentCharge = parseFloat(amount / 100 * percentCharge);
                }

                let totalCharge = parseFloat(totalPercentCharge + fixedCharge);
                let totalAmount = parseFloat((amount || 0) + totalPercentCharge + fixedCharge);

                $(".final-amount").text(totalAmount.toFixed(2));
                $(".processing-fee").text(totalCharge.toFixed(2));
                $("input[name=currency]").val(gateway.currency);
                $(".gateway-currency").text(gateway.currency);

                if (amount < Number(gateway.min_amount) || amount > Number(gateway.max_amount)) {
                    $(".deposit-form button[type=submit]").attr('disabled', true);
                } else {
                    $(".deposit-form button[type=submit]").removeAttr('disabled');
                }

                if (gateway.currency != "{{ gs('cur_text') }}" && gateway.method.crypto != 1) {
                    $('.deposit-form').addClass('adjust-height')

                    $(".gateway-conversion, .conversion-currency").removeClass('d-none');
                    $(".gateway-conversion").find('.deposit-info__input .text').html(
                        `1 {{ __(gs('cur_text')) }} = <span class="rate">${parseFloat(gateway.rate).toFixed(2)}</span>  <span class="method_currency">${gateway.currency}</span>`
                    );
                    $('.in-currency').text(parseFloat(totalAmount * gateway.rate).toFixed(gateway.method.crypto == 1 ?
                        8 : 2))
                } else {
                    $(".gateway-conversion, .conversion-currency").addClass('d-none');
                    $('.deposit-form').removeClass('adjust-height')
                }

                if (gateway.method.crypto == 1) {
                    $('.crypto-message').removeClass('d-none');
                } else {
                    $('.crypto-message').addClass('d-none');
                }
            }

            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
            $('.gateway-input').change();
        })(jQuery);
    </script>
@endpush
