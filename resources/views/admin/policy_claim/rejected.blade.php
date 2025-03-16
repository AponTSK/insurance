@extends('admin.layouts.app')
@section('panel')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('Claim ID | Policy')</th>
                                    <th>@lang('Requested By')</th>
                                    <th>@lang('Amount Requested')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($claims as $claim)
                                    <tr>
                                        <td>
                                            <span class="fw-bold">
                                                <a href="">
                                                    {{ $claim->claim_id }}
                                                </a>
                                            </span><br>
                                            <small>@lang('Policy'): {{ $claim->insuredPlan->plan->name ?? 'N/A' }}</small>
                                        </td>

                                        <td>
                                            <span class="fw-bold">{{ $claim->user->fullname }}</span><br>
                                            <span class="small">
                                                <a href="{{ appendQuery('search', @$claim->user->username) }}"><span>@</span>{{ $claim->user->username }}</a>
                                            </span>
                                        </td>

                                        <td>
                                            {{ showAmount($claim->request_amount) }}
                                        </td>

                                        <td>
                                            @php echo $claim->statusBadge @endphp
                                        </td>

                                        <td>
                                            <a href="{{ route('admin.policy.claim.details', $claim->id) }}" class="btn btn-sm btn-outline--primary ms-1">
                                                <i class="la la-desktop"></i> @lang('Details')
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __('No claim requests found.') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>

                @if ($claims->hasPages())
                    <div class="card-footer py-4">
                        @php echo paginateLinks($claims) @endphp
                    </div>
                @endif
            </div><!-- card end -->
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <x-search-form dateSearch='yes' placeholder='Claim ID / User' />
@endpush
