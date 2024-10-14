@extends('frontend.layouts')

@section('content')
<div class="container mb-5" style="margin-top: 70px !important">
    <div class="d-flex justify-content-between mb-3">
        <h3 class="fw-bold">All Blogs</h3>
        {{-- <a class="btn btn-primary" href="">View All Services <i class="bi bi-arrow-right ms-2"></i></a> --}}
    </div>

    <div class="row">
        @foreach ($blogs as $blog)
            <div class="col-md-3 mb-4">
                <div class="card card-service">
                    <img src="{{ $blog->image ? asset($blog->image) : '' }}" alt="Latest blogs" class="img-fluid service_img" style="height: 200px;">
                    <div class="card-body">
                        <!-- Format the date dynamically in DD/MM/YYYY format -->
                        <p class="fw-bold m-0 text-center">{{ \Carbon\Carbon::parse($blog->created_at)->format('d/m/Y') }}</p>
                        <hr style="opacity: .1">
                        <p class="card-text">{{ Str::limit($blog->title, 28) }}</p>
                        <hr style="opacity: .1">
                        <div class="d-flex justify-content-center">
                            <a class="text-primary fw-bold" href="{{ route('frontend.blog.details', $blog->id) }}">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
</div>
@endsection