@extends('frontend.layouts')

@section('content')
<div class="container mb-5" style="margin-top: 70px !important">
    <div class="d-flex justify-content-between mb-3">
        <h3 class="fw-bold">Our Services</h3>
        {{-- <a class="btn btn-primary" href="">View All Services <i class="bi bi-arrow-right ms-2"></i></a> --}}
    </div>

    <div class="row">
        @foreach ($services as $service)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card card-service">
                    <img style="height: 190px; object-fit: cover;" src="{{ $service->image ? asset($service->image) : '' }}" class="img-fluid service_img">
                    <div class="card-body">
                        <a href="{{ route('frontend.service.details', $service->id) }}">
                            <p class="card-text fw-bold">{{ \Illuminate\Support\Str::limit($service->title, 28) }}</p>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
</div>
@endsection