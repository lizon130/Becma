@extends('frontend.layouts')

@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">  
            <div class="col-lg-8 d-flex flex-column justify-content-center">
                <img src="{{ $news->image ? asset($news->image) : 'default-image.jpg' }}" alt="{{ $news->title }}" class="w-100 rounded" style="height: 400px; object-fit: cover">
                <h3 class="fw-bold mt-4">{{ $news->title }}</h3>
                <p class="text-muted">{!! $news->description !!}</p>
            </div>
        </div>
    </div>
@endsection