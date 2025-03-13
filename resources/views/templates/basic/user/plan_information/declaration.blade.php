@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="dashboard-body">
        <div class="insurance-plan-wrapper">
            <x-plan-info />
            <div class="insurance-plan-wrapper__body">
                <div class="row">
                    <div class="col-xxl-10">
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="info-wrapper">
                                    <h6 class="info-wrapper__title">
                                        Policy Information
                                    </h6>
                                    <div class="info-card">
                                        <ul class="info-list">
                                            <li class="info-list__item">
                                                <span class="info-list__title">
                                                    Policy Name:
                                                </span>
                                                <span class="info-list__text">
                                                    Life Insurance Policy
                                                </span>
                                            </li>
                                            <li class="info-list__item">
                                                <span class="info-list__title">
                                                    Policy Duration:
                                                </span>
                                                <span class="info-list__text"> 1 Year </span>
                                            </li>
                                            <li class="info-list__item">
                                                <span class="info-list__title">
                                                    Coverage Amount:
                                                </span>
                                                <span class="info-list__text">
                                                    $250,000
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="info-main-container">
                                <div class="info-wrapper">
                                    <h6 class="info-wrapper__title">
                                        Insured Information
                                    </h6>
                                    <div class="info-card">
                                        <ul class="info-list">
                                            <li class="info-list__item">
                                                <span class="info-list__title">
                                                    Insured:
                                                </span>
                                                <span class="info-list__text">
                                                    Cameron Williamson
                                                </span>
                                            </li>
                                            <li class="info-list__item">
                                                <span class="info-list__title">
                                                    NID Number:
                                                </span>
                                                <span class="info-list__text">
                                                    797675718879
                                                </span>
                                            </li>
                                            <li class="info-list__item">
                                                <span class="info-list__title">
                                                    Phone Number:
                                                </span>
                                                <span class="info-list__text">
                                                    (319) 555-0115
                                                </span>
                                            </li>
                                            <li class="info-list__item">
                                                <span class="info-list__title">
                                                    Issue Age:
                                                </span>
                                                <span class="info-list__text"> 40 </span>
                                            </li>
                                            <li class="info-list__item">
                                                <span class="info-list__title">
                                                    Date of Birth:
                                                </span>
                                                <span class="info-list__text">
                                                    November 28, 1964
                                                </span>
                                            </li>
                                            <li class="info-list__item">
                                                <span class="info-list__title">
                                                    Gender:
                                                </span>
                                                <span class="info-list__text"> Male </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="info-wrapper">
                                    <h6 class="info-wrapper__title">
                                        Spouse Information
                                    </h6>
                                    <div class="info-card">
                                        <ul class="info-list">
                                            <li class="info-list__item">
                                                <span class="info-list__title">
                                                    Insured:
                                                </span>
                                                <span class="info-list__text">
                                                    Cameron Williamson
                                                </span>
                                            </li>
                                            <li class="info-list__item">
                                                <span class="info-list__title">
                                                    NID Number:
                                                </span>
                                                <span class="info-list__text">
                                                    797675718879
                                                </span>
                                            </li>
                                            <li class="info-list__item">
                                                <span class="info-list__title">
                                                    Phone Number:
                                                </span>
                                                <span class="info-list__text">
                                                    (319) 555-0115
                                                </span>
                                            </li>
                                            <li class="info-list__item">
                                                <span class="info-list__title">
                                                    Issue Age:
                                                </span>
                                                <span class="info-list__text"> 40 </span>
                                            </li>
                                            <li class="info-list__item">
                                                <span class="info-list__title">
                                                    Date of Birth:
                                                </span>
                                                <span class="info-list__text">
                                                    November 28, 1964
                                                </span>
                                            </li>
                                            <li class="info-list__item">
                                                <span class="info-list__title">
                                                    Gender:
                                                </span>
                                                <span class="info-list__text"> Male </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="info-wrapper">
                                    <h6 class="info-wrapper__title">
                                        Nominee Information
                                    </h6>
                                    <div class="info-card">
                                        <ul class="info-list">
                                            <li class="info-list__item">
                                                <span class="info-list__title">
                                                    Insured:
                                                </span>
                                                <span class="info-list__text">
                                                    Cameron Williamson
                                                </span>
                                            </li>
                                            <li class="info-list__item">
                                                <span class="info-list__title">
                                                    NID Number:
                                                </span>
                                                <span class="info-list__text">
                                                    797675718879
                                                </span>
                                            </li>
                                            <li class="info-list__item">
                                                <span class="info-list__title">
                                                    Phone Number:
                                                </span>
                                                <span class="info-list__text">
                                                    (319) 555-0115
                                                </span>
                                            </li>
                                            <li class="info-list__item">
                                                <span class="info-list__title">
                                                    Issue Age:
                                                </span>
                                                <span class="info-list__text"> 40 </span>
                                            </li>
                                            <li class="info-list__item">
                                                <span class="info-list__title">
                                                    Date of Birth:
                                                </span>
                                                <span class="info-list__text">
                                                    November 28, 1964
                                                </span>
                                            </li>
                                            <li class="info-list__item">
                                                <span class="info-list__title">
                                                    Gender:
                                                </span>
                                                <span class="info-list__text"> Male </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="btn--groups mt-4 d-flex flex-wrap gap-2">
                            <button class="btn btn--base">
                                Confirm & Payment
                                <span class="btn-icon">
                                    <i class="las la-angle-right"></i>
                                </span>
                            </button>
                            <a href="#" class="btn btn--white"> Back </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
