@extends('backend.include.app')
@section('content')
    <div class="container-fluid px-4">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
                <div class="card shadow border-0 rounded-lg mt-4">
                    <div class="card-header">
                        <h4 class="text-center my-2">{{ trans('Change Your Password') }}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.change.password') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-floating mb-3">
                                <input class="form-control" type="password" name="current_password" placeholder="{{ trans('Enter Current password') }}" required />
                                <label for="inputEmail">{{ trans('Enter Current password') }} <span class="text-danger">*</span></label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" type="password" name="password" placeholder="{{ trans('Enter New password') }}" required />
                                <label for="inputEmail">{{ trans('Enter New password') }} <span class="text-danger">*</span></label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputEmail" type="password" name="password_confirmation" placeholder="{{ trans('Enter New password Again') }}"  required />
                                <label for="inputEmail">{{ trans('Enter New password Again') }}<span class="text-danger">*</span></label>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                <button type="submit" class="btn btn-primary w-100" >{{ trans('Change Password') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('footer')
        <script>

        </script>
    @endpush
@endsection

