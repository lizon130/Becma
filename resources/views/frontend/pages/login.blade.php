@extends('frontend.layouts')

@section('content')
<section id="becma_login">
    <style>
            #becma_login .bg-full {
                background-color: #11223a;
                padding: 0px;
                /* border-radius: 20px; */
            }
            #becma_login .registration-form {
                background: #ecf2fb;
                padding: 56px;
                /* border-radius: 10px; */
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
            #becma_login  .registration-form .form-group {
                position: relative;
            }
            #becma_login .registration-form .form-group i {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                right: 15px;
                font-size: 18px;
                color: #999;
            }
            #becma_login .registration-form .form-control {
                padding-right: 40px;
            }
            #becma_login .registration-form img {
                max-width: 100%;
                height: auto;
            }
            #becma_login .terms {
                display: flex;
                align-items: center;
            }
            @media (min-width: 768px) {
                #becma_login .form-row .col-md-6 {
                    display: flex;
                    flex-direction: column;
                }
            }

            #becma_login .custom-input:focus {
            border-color: #5582B0;
            /* box-shadow: 0 0 5px rgba(65, 138, 248, 0.5);  */
            box-shadow: none;
            outline: none;
        }
    </style>

    <div class="container mt-5 mb-5 bg-full">
        <div class="row justify-content-center">
                    <!-- Image Section -->
                    <div class="col-md-5 text-center">
                        <img src="{{ asset('assets/img/reg_img.png') }}" alt="Illustration Image" class="img-fluid">
                    </div>
                    <!-- Registration Form -->
                    <div class="col-md-7">
                        <div class="registration-form">
                            <h3 class="text-center mb-4 fw-bold">Members Login</h3>
                            <form action ="" method="POST">
                               @csrf
                                <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Company Email</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="bi bi-envelope-at-fill"></i>
                                                </span>
                                                <input type="email" name="email" class="form-control custom-input" placeholder="ie: member@mail.com" value="{{ old('email') }}">
                                            </div>
                                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Password</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="bi bi-key-fill"></i>
                                                </span>
                                                <input type="password" name="password" class="form-control custom-input" placeholder="ie: A-Z, a-z, digit(0-9), special characters" value="{{ old('password') }}">
                                            </div>
                                            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                </div>


                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary mt-4 w-25" style="background: #11223a;">Login</button>
                                    </div>
                                    <p class="text-center mt-3">If you are not registered, <a class="btn btn-success"
                                         href="{{ route('frontend.registration') }}">Registration</a></p>
                            </form>
                        </div>
                    </div>
        </div>
    </div>
</section>
@endsection
