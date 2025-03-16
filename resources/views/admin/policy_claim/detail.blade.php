@extends('admin.layouts.app')

@section('panel')
    <div class="row mb-none-30">
        <div class="col-lg-4 col-md-4 mb-30">
            <div class="card overflow-hidden box--shadow1">
                <div class="card-body">
                    <h5 class="mb-20 text-muted">@lang('Claim Details')</h5>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Claim ID')
                            <span class="fw-bold">{{ $claim->claim_id }}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('User')
                            <span class="fw-bold">
                                <a href="{{ route('admin.users.detail', $claim->user_id) }}">
                                    <span>@</span>{{ @$claim->user->username }}
                                </a>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Requested Amount')
                            <span class="fw-bold">{{ showAmount($claim->request_amount) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Claim Date')
                            <span class="fw-bold">{{ showDateTime($claim->created_at) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Status')
                            @php echo $claim->statusBadge @endphp
                        </li>

                        @if ($claim->admin_feedback)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @lang('Admin Feedback')
                                <p>{{ $claim->admin_feedback }}</p>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-8 col-md-8 mb-30">
            <div class="card overflow-hidden box--shadow1">
                <div class="card-body">
                    <h5 class="card-title border-bottom pb-2">@lang('Claim Information')</h5>

                    @if ($details != null)
                        @foreach (json_decode($details) as $val)
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h6>{{ __($val->name) }}</h6>
                                    @if ($val->type == 'checkbox')
                                        {{ implode(',', $val->value) }}
                                    @elseif($val->type == 'file')
                                        @if ($val->value)
                                            <a href="{{ route('admin.download.attachment', encrypt(getFilePath('verify') . '/' . $val->value)) }}">
                                                <i class="fa-regular fa-file"></i> @lang('Attachment')
                                            </a>
                                        @else
                                            @lang('No File')
                                        @endif
                                    @else
                                        <p>{{ __($val->value) }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <div class="col-md-12">
                        <div class="row mt-4">
                            <h6>{{ __('Claim Reason') }}</h6>
                            <p>{{ __($claim->description) }}</p>
                        </div>
                        <div class="row mt-4">
                            <h6>{{ __('Claim Attachment') }}</h6>
                            @foreach ($claim->claimAttachments as $key => $item)
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

                    @if ($claim->status == Status::CLAIM_PENDING)
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <button class="btn btn-outline--success btn-sm ms-1" data-bs-toggle="modal" data-bs-target="#approveModal">
                                    <i class="las la-check"></i> @lang('Approve')
                                </button>

                                <button class="btn btn-outline--danger btn-sm ms-1" data-bs-toggle="modal" data-bs-target="#rejectModal">
                                    <i class="las la-ban"></i> @lang('Reject')
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- APPROVE MODAL --}}
    <div id="approveModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Approve Claim Confirmation')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="{{ route('admin.policy.claim.approve', $claim->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $claim->id }}">
                    <div class="modal-body">
                        <p>@lang('Are you sure you want to approve this claim?')</p>
                        <label>@lang('Approved Amount')</label>
                        <input type="number" name="approve_amount" class="form-control" placeholder="@lang('Enter approved amount')" required min="0" value="{{ old('approve_amount') }}">
                        <textarea name="details" class="form-control mt-3" rows="3" placeholder="@lang('Provide any additional details')" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- REJECT MODAL --}}
    <div id="rejectModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Reject Claim Confirmation')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="{{ route('admin.policy.claim.reject', $claim->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $claim->id }}">
                    <div class="modal-body">
                        <label>@lang('Reason for Rejection')</label>
                        <textarea name="details" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
