@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-2">
                    <form class="plan-form" method="POST" action="{{ route('admin.plan.save', $plan->id) }}" enctype="multipart/form-data">
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
                                    <input type="number" class="form-control" name="price" step="0.01" value="{{ old('price', $plan->price) }}" required />
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
                                    <input type="number" class="form-control" name="coverage_amount" step="0.01" required />
                                    <span class="input-group-text">@lang('USD')</span>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>@lang('Validity')</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="validity" required />
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
                                                data-off="@lang('Disable')" class="spouseCoverage" name="spouse_coverage" value="1">
                                        </div>
                                    </li>

                                    <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                        <div class="col-lg-10">
                                            <label>@lang('Children Coverage')</label>
                                        </div>
                                        <div class="col-lg-2">
                                            <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-bs-toggle="toggle" data-height="35" data-on="@lang('Enable')"
                                                data-off="@lang('Disable')" class="childrenCoverage" name="children_coverage" value="1">
                                        </div>
                                    </li>

                                    <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center children-number-field">
                                        <div class="col-lg-10">
                                            <label>@lang('No. of Children')</label>
                                        </div>
                                        <div class="col-lg-2">
                                            <input type="number" class="form-control noChildren" name="no_children" min="0" id="noChildren" disabled>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="modal-footer mt-3">
                                <button type="submit" class="btn btn--primary w-100 h-45">@lang('Update')</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
