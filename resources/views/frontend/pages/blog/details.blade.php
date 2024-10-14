@extends('frontend.layouts')

@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">  
            <div class="col-lg-8 d-flex flex-column justify-content-center">
                <img src="{{ $blogs->image ? asset($blogs->image) : 'default-image.jpg' }}" alt="{{ $blogs->title }}" class="w-100 rounded" style="height: 400px; object-fit: cover">
                <h3 class="fw-bold mt-4">{{ $blogs->title }}</h3>
                <p class="text-muted">{!! $blogs->description !!}</p>
            </div>
        </div>
    </div>
@endsection