@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="dashboard-body">
        <div class="dashboard-body__bar d-lg-none d-block">
            <span class="dashboard-body__bar-icon"><i class="fas fa-bars"></i></span>
        </div>

        <div class="dashboard-body__top">
            <div class="dashboard-body__left">
                <h4 class="title mb-0"> @lang('Your Claims Overview') </h4>
                <p class="text"> @lang('Track and manage all your submitted claims in one place.') </p>
            </div>
            <div class="dashboard-body__right">
                <button class="btn btn--sm btn--base"> @lang('New Claim') </button>
            </div>
        </div>
        <div class="row gy-4 mt-1">
            <table class="table table--responsive--xl">
                <thead>
                    <tr>
                        <th>@lang('ID') <span class="icon"> <i class="las la-arrow-down"></i> </span></th>
                        <th> @lang('Policy Type') </th>
                        <th> @lang('Claim Type') </th>
                        <th>@lang(' Coverage ')</th>
                        <th>@lang('Status')</th>
                        <th>@lang('Date Submitted') </th>
                        <th> @lang('Amount Requested')</th>
                        <th> @lang('Action') </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($claimRequests as $claimRequest)
                        <tr>
                            <td data-label="ID">#{{ $claimRequest->claim_id }}</td>
                            <td data-label="Policy Type"> {{ $claimRequest->insuredPlan->plan->name ?? 'N/A' }} </td>
                            <td data-label="Claim Type">
                                @if ($claimRequest->others_details)
                                    <span class="info-list__text">
                                        @foreach ($claimRequest->others_details as $val)
                                            @if ($val->name == 'Claim Type')
                                                {{ __($val->value) }}
                                            @endif
                                        @endforeach
                                    </span>
                                @endif
                            </td>
                            <td data-label="Coverage"> {{ showAmount($claimRequest->insuredPlan->coverage) }} </td>
                            <td data-label="Status"> @php echo $claimRequest->statusBadge @endphp</td>
                            <td data-label="Date Submitted"> {{ showDateTime($claimRequest->created_at, 'd M Y') }} </td>
                            <td data-label="Amount Requested"> {{ showAmount($claimRequest->request_amount) }} </td>
                            <td data-label="Action">
                                <div class="action-buttons">
                                    <button type="button" class="btn btn--base btn--xsm"> <i class="fa-solid fa-eye"></i> </button>
                                    <button type="button" class="btn btn--base btn--xsm">
                                        @lang('Details')
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>


    </div>
@endsection
