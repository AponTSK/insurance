@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two custom-data-table">
                            <thead>
                                <tr>
                                    <th>@lang('Title')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($notCovers as $notCover)
                                    <tr>
                                        <td>{{ __($notCover->title) }}</td>
                                        <td class="button--group">
                                            <button type="button" class="btn btn-outline--primary btn-sm edit-notCover-btn" data-notCover='@json($notCover)'>
                                                <i class="las la-pen"></i>@lang('Edit')
                                            </button>
                                            @if ($notCover->status == Status::DISABLE)
                                                <button type="button" class="btn btn-sm btn-outline--success confirmationBtn" data-action="{{ route('admin.notcover.status', $notCover->id) }}"
                                                    data-question="@lang('Are you sure to enable this notCover?')">
                                                    <i class="la la-eye"></i> @lang('Enable')
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-sm btn-outline--danger confirmationBtn" data-action="{{ route('admin.notcover.status', $notCover->id) }}"
                                                    data-question="@lang('Are you sure to disable this notCover?')">
                                                    <i class="la la-eye-slash"></i> @lang('Disable')
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if ($notCovers->hasPages())
                    <div class="card-footer py-4">
                        @php echo paginateLinks($notCovers) @endphp
                    </div>
                @endif
            </div>
        </div>
    </div>

    <x-confirmation-modal />

    <div class="modal fade notCover-modal" tabindex="-1" id="notCover-modal" data-bs-keyboard="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Add Not Covers')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form class="notCover-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group">
                                <label>@lang('Title')</label>
                                <input type="text" class="form-control" name="title" required />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <button type="button" class="btn btn-outline--primary add-notCover-btn btn-sm">
        <i class="las la-plus"></i> @lang('Add New')
    </button>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";

            const notCoverModal = $("#notCover-modal");
            const notCoverForm = $('.notCover-form');

            $('.add-notCover-btn').on('click', function() {
                notCoverModal.find('.modal-title').text('@lang('Add Not Cover')');
                notCoverForm.attr('action', '{{ route('admin.notcover.save') }}');
                notCoverForm.trigger('reset');
                notCoverModal.modal('show');
            });

            $('.edit-notCover-btn').on('click', function() {
                const notCover = $(this).data('notCover');
                notCoverModal.find('.modal-title').text('@lang('Edit Not Cover')');
                notCoverForm.attr('action', "{{ route('admin.notcover.save', '') }}/" + notCover.id);
                notCoverModal.find('input[name=title]').val(notCover.title);
                notCoverModal.modal('show');
            });
        })(jQuery);
    </script>
@endpush
