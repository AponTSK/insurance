@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="dashboard-body">
        <div class="insurance-plan-wrapper">
            <x-plan-info />
            <div class="insurance-plan-wrapper__body">
                <div class="information-container">
                    <div class="row">
                        <div class="col-xl-9">
                            <form action="{{ route('user.store.info') }}" method="POST">
                                @csrf
                                <div class="row gy-4">
                                    <div class="col-sm-6">
                                        <label for="name" class="form-label">
                                            @lang('Your Name')
                                        </label>
                                        <input type="text" name="name" class="form--control" placeholder="Cameron Williamson" id="name" />
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="date" class="form-label">
                                            @lang('Date of Birthday')
                                        </label>
                                        <input type="date" name="dob" class="form--control" id="date" />
                                    </div>
                                    <x-viser-form identifier="act" identifierValue="user" />

                                    <div class="col-sm-12">
                                        <div class="btn--groups">
                                            <button type="submit" class="btn btn--base">
                                                @lang('Next Step')
                                                <span class="btn-icon">
                                                    <i class="las la-arrow-right"></i>
                                                </span>
                                            </button>
                                            <a href="#" class="btn btn--white"> @lang('Back') </a>
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
