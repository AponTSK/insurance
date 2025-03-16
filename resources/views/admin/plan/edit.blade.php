@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-3">
                    <form method="POST" action="{{ route('admin.plan.save', $plan->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group">
                                <label>@lang('Name')</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', $plan->name) }}" required />
                            </div>
                            <div class="form-group">
                                <label>@lang('Category')</label>
                                <select name="category_id" class="form-control plan-category" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == $plan->category_id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('Feature')</label>
                                <select multiple name="feature_id[]" class="form-control plan-feature select2" required>
                                    @foreach ($features as $feature)
                                        <option value="{{ $feature->id }}" {{ in_array($feature->id, $plan->features->pluck('id')->toArray()) ? 'selected' : '' }}>
                                            {{ $feature->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('Will Not Cover')</label>
                                <select multiple name="not_cover_id[]" class="form-control plan-notCover select2" required>
                                    @foreach ($notCovers as $notCover)
                                        <option value="{{ $notCover->id }}" {{ in_array($notCover->id, $plan->notCovers->pluck('id')->toArray()) ? 'selected' : '' }}>
                                            {{ $notCover->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('Price')</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="price" step="0.01" value="{{ old('price', getAmount($plan->price)) }}" required />
                                    <span class="input-group-text">@lang('USD')</span>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>@lang('Payment Duration')</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="payment_duration" value="{{ old('payment_duration', $plan->payment_duration) }}" required />
                                    <span class="input-group-text">@lang('Days')</span>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('Coverage Amount')</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="coverage_amount" step="0.01" value="{{ old('coverage_amount', getAmount($plan->coverage_amount)) }}" required />
                                    <span class="input-group-text">@lang('USD')</span>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>@lang('Validity')</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="validity" value="{{ old('validity', $plan->validity) }}" required />
                                    <span class="input-group-text">@lang('Months')</span>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                        <div class="col-lg-10">
                                            <label>@lang('Spouse Coverage')</label>
                                        </div>
                                        <div class="col-lg-2">
                                            <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-bs-toggle="toggle" data-height="35" data-on="@lang('Enable')"
                                                data-off="@lang('Disable')" class="spouseCoverage" name="spouse_coverage" value="1" {{ $plan->spouse_coverage ? 'checked' : '' }}>
                                        </div>
                                    </li>

                                    <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                        <div class="col-lg-10">
                                            <label>@lang('Children Coverage')</label>
                                        </div>
                                        <div class="col-lg-2">
                                            <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-bs-toggle="toggle" data-height="35" data-on="@lang('Enable')"
                                                data-off="@lang('Disable')" class="childrenCoverage" name="children_coverage" value="1" {{ $plan->children_coverage ? 'checked' : '' }}>
                                        </div>
                                    </li>

                                    <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center children-number-field">
                                        <div class="col-lg-10">
                                            <label>@lang('No. of Children')</label>
                                        </div>
                                        <div class="col-lg-2">
                                            <input type="number" class="form-control noChildren" name="no_children" min="0" value="{{ old('no_children', $plan->no_children) }}"
                                                {{ $plan->children_coverage ? '' : 'disabled' }}>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="modal-footer mt-3">
                            <button type="submit" class="btn btn--primary w-100 h-45">@lang('Update')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";

            $('.plan-feature, .plan-notCover').select2();

            $('.childrenCoverage').on('change', function() {
                $('.noChildren').prop('disabled', !$(this).prop('checked')).val($(this).prop('checked') ? $('.noChildren').val() : 0);
            });

        })(jQuery);
    </script>
@endpush
