@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="dashboard-body">
        <div class="row gy-4 justify-content-center">
            <div class="col-xl-4 col-sm-6">
                <div class="dashboard-widget">
                    <h4 class="dashboard-widget__titel">Policy Overview</h4>
                    <p class="dashboard-widget__text">
                        Total Active Policies: 3
                    </p>
                    <p class="dashboard-widget__text">Upcoming Renewals:</p>
                    <p class="dashboard-widget__desc">
                        Car Insurance - Due February 15, 2025
                    </p>
                    <div class="dashboard-widget__btn">
                        <button class="btn btn--base">Renew Now</button>
                    </div>
                    <div class="dashboard-widget__shape">
                        <img src="assets/images/shapes/ds-1.png" alt="" />
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6">
                <div class="dashboard-widget">
                    <h4 class="dashboard-widget__titel">Claims Summary</h4>
                    <p class="dashboard-widget__text">Ongoing Claims: 1</p>
                    <div class="dashboard-widget__btn">
                        <button class="btn btn--base">Track Claims</button>
                    </div>
                    <div class="dashboard-widget__shape">
                        <img src="assets/images/shapes/ds-1.png" alt="" />
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6">
                <div class="dashboard-widget">
                    <h4 class="dashboard-widget__titel">Quick Actions</h4>
                    <div class="dashboard-widget__btn-group">
                        <button type="button" class="btn btn--base btn--sm w-100">
                            Renew Policy
                        </button>
                        <button type="button" class="btn btn--base btn--sm w-100">
                            Submit a Claims
                        </button>
                        <button type="button" class="btn btn--base btn--sm w-100">
                            Download Documents
                        </button>
                    </div>
                    <div class="dashboard-widget__shape">
                        <img src="assets/images/shapes/ds-1.png" alt="" />
                    </div>
                </div>
            </div>
        </div>
        <!-- Dashboard Card End -->

        <div class="row gy-4 mt-1">
            <div class="col-xl-5">
                <div class="card custom--card">
                    <div class="card-body">
                        <h4 class="card-title">Performance Analytics</h4>
                    </div>
                </div>
            </div>
            <div class="col-xl-7">
                <div class="card custom--card">
                    <div class="card-body">
                        <h4 class="card-title">Premium Payments Trend</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row gy-4 mt-1">
            <div class="col-xxl-6">
                <div class="dashboard-table">
                    <div class="dashboard-table__top">
                        <h4 class="dashboard-table__title">Top Policy Summary</h4>
                    </div>
                    <table class="table table--responsive--lg">
                        <thead>
                            <tr>
                                <th>
                                    ID
                                    <span class="icon">
                                        <i class="las la-arrow-down"></i>
                                    </span>
                                </th>
                                <th>Policy Type</th>
                                <th>Coverage</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td data-label="ID">#95954</td>
                                <td data-label="Policy Type">Home Insurance</td>
                                <td data-label="Coverage">$ 2,000.00</td>
                                <td data-label="Status">
                                    <span class="badge badge--success">
                                        <span class="badge__icop">
                                            <i class="las la-check"></i>
                                        </span>
                                        Active
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td data-label="ID">#95954</td>
                                <td data-label="Policy Type">Home Insurance</td>
                                <td data-label="Coverage">$ 2,000.00</td>
                                <td data-label="Status">
                                    <span class="badge badge--success">
                                        <span class="badge__icop">
                                            <i class="las la-check"></i>
                                        </span>
                                        Active
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6">
                <div class="card custom--card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Recent Activity</h4>
                        <ul class="content-list list-two">
                            <li class="content-list__item">
                                Policy #A12345 was updated.
                            </li>
                            <li class="content-list__item">
                                Policy #A12345 was updated.
                            </li>
                            <li class="content-list__item">
                                Premium payment of $500 made.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6">
                <div class="card custom--card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Recommendations</h4>
                        <ul class="content-list list-two">
                            <li class="content-list__item">
                                Upgrade your Life Insurance to $500,000 for added
                                benefits.
                            </li>
                            <li class="content-list__item">
                                Claim #B56789 has been processed.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>




    @if (auth()->user()->kv == Status::KYC_UNVERIFIED && auth()->user()->kyc_rejection_reason)
        <div class="modal fade" id="kycRejectionReason">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('KYC Document Rejection Reason')</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>{{ auth()->user()->kyc_rejection_reason }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
