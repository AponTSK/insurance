@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="dashboard-body">
        <div class="dashboard-body__bar d-lg-none d-block">
            <span class="dashboard-body__bar-icon"><i class="fas fa-bars"></i></span>
        </div>

        <div class="dashboard-body__top">
            <div class="dashboard-body__left">
                <h4 class="title mb-0"> @lang('Your Policy Overview') </h4>
                <p class="text"> @lang('Track and manage all your submitted policies in one place.') </p>
            </div>
            <div class="dashboard-body__right">
                <a href="{{ route('user.insurance.info') }}" class="btn btn--sm btn--base"> @lang('Get Insurance') </a>
            </div>
        </div>
        <div class="row gy-4 mt-1">
            <table class="table table--responsive--xl">
                <thead>
                    <tr>
                        <th>@lang('ID') <span class="icon"> <i class="las la-arrow-down"></i> </span></th>
                        <th> @lang('Policy Type') </th>
                        <th> @lang('Coverage') </th>
                        <th>@lang('Status')</th>
                        <th>@lang('Renewal Date')</th>
                        <th> @lang('Premium Payment')</th>
                        <th> @lang('Next Payment Due')</th>
                        <th> @lang('Action') </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($insuredPlans as $insuredPlan)
                        <tr>
                            <td data-label="ID">{{ $insuredPlan->policy_number }}</td>
                            <td data-label="Policy Type">{{ $insuredPlan->plan->name ?? 'N/A' }}</td>
                            <td data-label="Coverage">{{ showAmount($insuredPlan->coverage) }}</td>
                            <td data-label="Status"> @php echo $insuredPlan->statusBadge @endphp</td>
                            <td>{{ showDateTime($insuredPlan->renewal_date, 'd M Y') }}</td>
                            <td>{{ showAmount($insuredPlan->price) }}</td>
                            <td>{{ showDateTime($insuredPlan->next_payment_date, 'd M Y') }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('user.policy.details', $insuredPlan->id) }}" class="btn btn--base btn--xsm"> <i class="fa-solid fa-eye"></i> </a>
                                    <a href="{{ route('user.policy.details', $insuredPlan->id) }}" class="btn btn--base btn--xsm"> @lang('Details') </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>


    </div>
@endsection
