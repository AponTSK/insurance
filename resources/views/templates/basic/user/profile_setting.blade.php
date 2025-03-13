@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card custom--card">
                    <div class="card-header">
                        <h5 class="card-title">@lang('Profile')</h5>
                    </div>
                    <div class="card-body">
                        <form class="register" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row align-items-center">

                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label class="form--label">@lang('First Name')</label>
                                        <input type="text" class="form-control form--control" name="firstname" value="{{ $user->firstname }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form--label">@lang('Last Name')</label>
                                        <input type="text" class="form-control form--control" name="lastname" value="{{ $user->lastname }}" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <img class="profile-image fit-image" src="{{ getImage(getFilePath('userProfile') . '/' . $user->image) }}" alt="Profile Image" />
                                    <input type="file" class="image-upload form-control form--control" name="profile_image" accept="image/*" style="display: none;">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="form--label">@lang('E-mail Address')</label>
                                    <input class="form-control form--control" value="{{ $user->email }}" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="form--label">@lang('Mobile Number')</label>
                                    <input class="form-control form--control" value="{{ $user->mobile }}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="form--label">@lang('Address')</label>
                                    <input type="text" class="form-control form--control" name="address" value="{{ @$user->address }}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="form--label">@lang('State')</label>
                                    <input type="text" class="form-control form--control" name="state" value="{{ @$user->state }}">
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label class="form--label">@lang('Zip Code')</label>
                                    <input type="text" class="form-control form--control" name="zip" value="{{ @$user->zip }}">
                                </div>

                                <div class="form-group col-sm-4">
                                    <label class="form--label">@lang('City')</label>
                                    <input type="text" class="form-control form--control" name="city" value="{{ @$user->city }}">
                                </div>

                                <div class="form-group col-sm-4">
                                    <label class="form--label">@lang('Country')</label>
                                    <input class="form-control form--control" value="{{ @$user->country_name }}" disabled>
                                </div>

                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .profile-image {
            width: 180px;
            height: 180px;
            border-radius: 15%;
            object-fit: cover;
            border: 2px solid #ddd;
            padding: 5px;
            margin-bottom: 5px;
        }
    </style>
@endpush

@push('script-lib')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const profileImages = document.querySelectorAll(".profile-image");
            const imageUploads = document.querySelectorAll(".image-upload");

            profileImages.forEach((image, index) => {
                image.addEventListener("click", function() {
                    imageUploads[index].click();
                });

                imageUploads[index].addEventListener("change", function(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            image.src = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                });
            });
        });
    </script>
@endpush
