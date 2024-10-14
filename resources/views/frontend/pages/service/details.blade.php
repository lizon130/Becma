@extends('frontend.layouts')

@section('content')
    <div class="container my-4">
        <div class="row">
                <img src="{{ $service->image ? asset($service->image) : 'default-image.jpg' }}" alt="{{ $service->title }}" class="w-100 rounded" style="height: 400px; object-fit: cover">

            <div class="col-lg-8 d-flex flex-column justify-content-center">
                <h3 class="fw-bold mt-4">{{ $service->title }}</h3>
                <p class="text-muted">{!! $service->description !!}</p>
            </div>
        </div>
    </div>
@endsection