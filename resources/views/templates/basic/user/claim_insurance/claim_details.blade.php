@extends($activeTemplate . 'layouts.master')

@section('content')
    <div class="dashboard-body">
        <div class="dashboard-body__bar d-lg-none d-block">
            <span class="dashboard-body__bar-icon"><i class="fas fa-bars"></i></span>
        </div>
        <div class="insurance-plan-wrapper">
            <div class="insurance-plan-wrapper__header">
                <h4 class="title"> @lang('Insurance Claim Form') </h4>
                <p class="text"> @lang('Easily file, track, and manage your claims hassle-free.') </p>
                <div class="insurance-plan-wrapper__shape">
                    <img src="{{ asset($activeTemplateTrue . 'images/ds-2.png') }}" alt="image">
                </div>
            </div>
            <div class="plan-info">
                @include('Template::user.claim_insurance.claim_header', ['claimId' => $claimRequest->id])

            </div>
            <div class="insurance-plan-wrapper__body">
                <form action="{{ route('user.claim.insurance.confirm.submit', $claimRequest->id) }}" method="POST">
                    @csrf
                    <div class="information-container">
                        <div class="row gy-3">
                            <div class="col-xl-6">
                                <div class="card custom--card">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h5>@lang('Policy holder information')</h5>
                                        </div>
                                        <div class="card-body p-0">
                                            <div class="form-group border border p-3">
                                                <div class="d-flex justify-content-between">
                                                    <strong>@lang('Name')</strong>
                                                    <span>{{ $claimRequest->user->fullname }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group border border p-3">
                                                <div class="d-flex justify-content-between">
                                                    <strong>@lang('Email')</strong>
                                                    <span>{{ $claimRequest->email }}</span>
                                                </div>
                                            </div>

                                            <div class="form-group border border p-3">
                                                <div class="d-flex justify-content-between">
                                                    <strong>@lang('Phone Number')</strong>
                                                    <span>+{{ $claimRequest->phone }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group border border p-3">
                                                <div class="d-flex justify-content-between">
                                                    <strong>@lang('Nid Number')</strong>
                                                    <span>{{ $claimRequest->nid }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group border border p-3">
                                                <div class="d-flex justify-content-between">
                                                    <strong>@lang('Date of Birth')</strong>
                                                    <span>{{ $claimRequest->dob }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card custom--card">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h5>@lang('Accident details')</h5>
                                        </div>
                                        <div class="card-body p-0">
                                            <div class="form-group border border p-3">
                                                <div class="d-flex justify-content-between">
                                                    <strong>@lang('Plan Name')</strong>
                                                    <span>{{ $claimRequest->insuredPlan->plan->name }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group border border p-3">
                                                <div class="d-flex justify-content-between">
                                                    <strong>@lang('Request Amount')</strong>
                                                    <span>{{ $claimRequest->request_amount }}</span>
                                                </div>
                                            </div>

                                            @foreach ($claimRequest->others_details as $val)
                                                <div class="form-group border border p-3">
                                                    <div class="d-flex justify-content-between">
                                                        <strong>{{ __($val->name) }}</strong>
                                                        @if ($val->type == 'checkbox')
                                                            {{ implode(',', $val->value) }}
                                                        @elseif($val->type == 'file')
                                                            @if ($val->value)
                                                                <a href="{{ route('user.download.attachment', encrypt(getFilePath('verify') . '/' . $val->value)) }}"><i class="fa-regular fa-file"></i> @lang('Attachment')
                                                                </a>
                                                            @else
                                                                @lang('No File')
                                                            @endif
                                                        @else
                                                            <span>{{ __($val->value) }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach

                                            @foreach ($claimRequest->claimAttachments as $key => $item)
                                                <div class="form-group border border p-3">
                                                    <div class="d-flex justify-content-between">
                                                        <strong>@lang('Attachment '){{ $key + 1 }}</strong>

                                                        <a href="{{ route('user.claim.insurance.download.file', encrypt($item->id)) }}">

                                                            <img src="{{ getImage(getFilePath('claimAttachments') . '/' . $item->attachment) }}" alt="attachment">
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card custom--card">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h5>@lang('Description')</h5>
                                        </div>
                                        <div class="card-body p-0">
                                            <div class="form-group">

                                                <p class="form-control">{{ $claimRequest->description }}</p>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-12">
                                <div class="btn--groups">
                                    <button type="submit" class="btn btn--base">
                                        @lang('Confirm & Submit')
                                        <span class="btn-icon">
                                            <i class="las la-arrow-right"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Dashboard Body End -->
@endsection
