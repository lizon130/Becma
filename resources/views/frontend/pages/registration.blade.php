@extends('frontend.layouts')

@section('content')
<section id="becma_register">
    <style>
            #becma_register .bg-full {
                background-color: #11223a;
                padding: 0px;
                /* border-radius: 20px; */
            }
            #becma_register .registration-form {
                background: #ecf2fb;
                padding: 30px;
                /* border-radius: 10px; */
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
            #becma_register  .registration-form .form-group {
                position: relative;
            }
            #becma_register .registration-form .form-group i {
                position: absolute;
                top: 50%; 
                transform: translateY(-50%);
                right: 15px;
                font-size: 18px;
                color: #999;
            }
            #becma_register .registration-form .form-control {
                padding-right: 40px;
            }
            #becma_register .registration-form img {
                max-width: 100%;
                height: auto;
            }
            #becma_register .terms {
                display: flex;
                align-items: center;
            }
            @media (min-width: 768px) {
                #becma_register .form-row .col-md-6 {
                    display: flex;
                    flex-direction: column;
                }
            }

            #becma_register .custom-input:focus {
            border-color: #5582B0;
            /* box-shadow: 0 0 5px rgba(65, 138, 248, 0.5);  */
            box-shadow: none; 
            outline: none; 
        }
    </style>
    <div class="container mt-5 mb-5 bg-full">
        <div class="row justify-content-center align-items-center">
                    <!-- Image Section -->
                    <div class="col-md-5 text-center">
                        <img src="{{ asset('assets/img/reg_img.png') }}" alt="Illustration Image" class="img-fluid">
                    </div>
                    <!-- Registration Form -->
                    <div class="col-md-7">
                        <div class="registration-form">
                            <h3 class="text-center mb-4 fw-bold">To Be a Members</h3>
                            <form action ="{{ route('register') }}" method="POST">
                               @csrf 
                                <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Company Name</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="bi bi-house-fill"></i>
                                                </span>
                                                <input type="text" name="company_name" class="form-control custom-input" placeholder="Your Company Name" value="{{ old('company_name') }}">
                                            </div>
                                            @error('company_name') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Email (Representative)</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="bi bi-envelope-at-fill"></i>
                                                </span>
                                                <input type="email" name="email" class="form-control custom-input" placeholder="ie: member@mail.com" value="{{ old('email') }}">
                                            </div>
                                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                </div>

                                <div class="row mt-4">
                                        <div class="col-md-6">
                                            <label class="form-label">Mobile (Representative)</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="bi bi-phone-fill"></i>
                                                </span>
                                                <input type="text" name="mobile" class="form-control custom-input" placeholder="ie: 01*****" value="{{ old('mobile') }}">
                                            </div>
                                                @error('mobile') <span class="text-danger">{{ $message }}</span> @enderror
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

                                <div class="row mt-4">
                                        <div class="col-md-6">
                                            <label class="form-label">Confirm Password</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="bi bi-key-fill"></i>
                                                </span>
                                                <input type="password" name="password_confirmation" class="form-control custom-input" placeholder="Re-type your password">
                                            </div>
                                        </div>

                                        <div class="col-md-6 mt-4 d-flex">
                                            <input type="checkbox" class="form-check-input custom-input" name="terms" id="terms" required>
                                            <label class="form-check-label ms-2" for="terms">
                                                You must agree with above <a href="#">Terms & Conditions</a>
                                            </label>
                                        </div>
                                </div>

                                    <div class="d-flex justify-content-center align-items-center">
                                        <button type="submit" class="btn btn-primary mt-4 w-25" style="background: #11223a;">Submit</button>
                                    </div>
                                    <p class="text-center mt-3">If you are already registered, <a class="btn btn-success" href="{{ url('login') }}">Login</a></p>
                            </form>                           
                        </div>
                    </div>
        </div>
    </div>
</section>

  <!-- SweetAlert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    @if(Session::has('message'))
    Swal.fire({
        icon: 'success',
        title: 'Successfully Registered!',
        html: '<a href="{{ url('/') }}" class="btn btn-primary" style="margin-top: 10px;">Go Home</a>',
        showConfirmButton: false,
        allowOutsideClick: false,  // Prevents closing the modal by clicking outside
        timer: 3000,               // Optional: keeps the alert open for 3 seconds
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    @endif
</script>
@endsection