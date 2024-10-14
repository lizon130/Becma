@extends('frontend.layouts')

@section('content')
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero" style="background-image: url('{{ Helper::getSettings('hero_banner_image') ? asset('uploads/settings/' . Helper::getSettings('hero_banner_image')) : asset('backend/assets/img/default-image.jpg') }}')">

    <div class="container position-relative">
      <div class="row gy-5" data-aos="fade-in">
        <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start">
            
            {!! Helper::getSettings('hero_section_heading') !!}

          <div class="d-flex justify-content-center justify-content-lg-start">
            <a href="{{ route('frontend.registration') }}" class="btn btn-primary p-2">Member Registration <i class="bi bi-arrow-right ms-2"></i></a>
          </div>
        </div>

        <div class="col-lg-6 order-1 order-lg-2">
          <div id="herocarouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#herocarouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#herocarouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#herocarouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="10000">
                    <img style="height: 350px !important" src="{{ Helper::getSettings('hero_image_1') ? asset('uploads/settings/' . Helper::getSettings('hero_image_1')) : asset('assets/img/cta-bg.jpg') }}" class="w-100 border-1 border border-4 rounded-5 hero_car_img" alt="" data-aos="zoom-out" data-aos-delay="100">
                </div>
                
              <div class="carousel-item" data-bs-interval="2000">
                <img style="height: 350px !important" src="{{ Helper::getSettings('hero_image_1') ? asset('uploads/settings/' . Helper::getSettings('hero_image_2')) : asset('assets/img/cta-bg.jpg') }}" class="w-100 border-1 border border-4 rounded-5 hero_car_img" alt="" data-aos="zoom-out" data-aos-delay="100">
              </div>

              <div class="carousel-item">
              <img style="height: 350px !important" src="{{ Helper::getSettings('hero_image_1') ? asset('uploads/settings/' . Helper::getSettings('hero_image_3')) : asset('assets/img/cta-bg.jpg') }}" class="w-100 border-1 border border-4 rounded-5 hero_car_img" alt="" data-aos="zoom-out" data-aos-delay="100">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Hero Section -->

<main id="main">

    <!-- Mission/Vission -->
    <div class="container mt-5 mb-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <ul class="nav nav-tabs d-block mission-nav" id="myTab" role="tablist">
                        <div class="row">
                            <div class="col-md-6">
                                <li class="nav-item text-center" role="presentation" style="background-color: rgb(226 231 231 / 49%);    border-start-start-radius: 16px; border-start-end-radius: 16px;">
                                    <a class="nav-link active" id="mission-tab" data-bs-toggle="tab" href="#mission" role="tab" aria-controls="mission" aria-selected="true">Mission</a>
                                </li>
                            </div>
                            <div class="col-md-6">
                                <li class="nav-item text-center" role="presentation" style="background-color: rgb(226 231 231 / 49%); border-start-start-radius: 16px; border-start-end-radius: 16px;">
                                    <a class="nav-link" id="vision-tab" data-bs-toggle="tab" href="#vision" role="tab" aria-controls="vision" aria-selected="false">Vision</a>
                                </li>
                            </div>
                        </div>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="mission" role="tabpanel" aria-labelledby="mission-tab">
                            <div class="mission-card card mt-3 p-3">
                                <p>
                                    {!! Helper::getSettings('mission') !!}
                                </p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="vision" role="tabpanel" aria-labelledby="vision-tab">
                            <div class="mission-card card mt-3 p-3">
                                <p>
                                    {!! Helper::getSettings('vision') !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <!-- Mission/Vission -->

    <!-- CTA -->
    <div class="container-wrapper mt-5 mb-5">
        <div class="banner-cta" style="background-image: url('{{ Helper::getSettings('cta_image') ? asset('uploads/settings/' . Helper::getSettings('cta_image')) : asset('backend/assets/img/default-image.jpg') }}')">
            <div class="banner-content-cta">
                {!! Helper::getSettings('cta_header') !!}
            </div>
        </div>
    </div>
    <!-- CTA -->

    <!-- Benefits of Members -->
    <div class="container mt-5 mb-5">
        <div class="row member-section">
            <!-- Left section with image -->
            <div class="col-md-6">
                <h3 class="fw-bold">Latest Members</h3>
                <img src="{{ asset('assets/img/ss.png') }}" alt="Latest Members" class="w-100">
            </div>

            <!-- Right section with benefits -->
            <div class="col-md-6 benefits-section p-2 rounded" style="background: #E7EFFE">
                <h3 class="fw-bold mt-4 ms-3">Benefits of Members</h3>
                <div class="p-5">
                    {!! Helper::getSettings('about_us') !!}
                </div>
                <div class="mb-2">
                    <a href="#" class="btn btn-primary ms-3">Read more</a>
                </div>
            </div>  
        </div>
    </div>
    <!-- Benefits of Members -->

    <!-- Services -->
    <div class="container mb-5" style="margin-top: 70px !important">
        <div class="d-flex justify-content-between mb-3">
            <h3 class="fw-bold">Our Services</h3>
            <a class="btn btn-primary" href="{{ route('frontend.service.all') }}">View All Services<i class="bi bi-arrow-right ms-2"></i></a>
        </div>

        <div id="service_carouselExample" class="owl-carousel owl-theme">

            @foreach ($services as $service)
                <div class="item">
                    <div class="card card-service">
                        <img style="height: 190px" src="{{ $service->image ? asset($service->image) : '' }}"
                            class="img-fluid service_img">
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
    <!-- Services -->

    <!-- Events -->
   <div class="container-wrapper p-4" style="background: #E7EFFE">
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-between mb-3">
            <h3 class="fw-bold">Our Events</h3>
            <a class="btn btn-primary" href="">View All Events <i class="bi bi-arrow-right ms-2"></i></a>
        </div>

        <div id="event_carouselExample" class="owl-carousel owl-theme">
            @foreach ($events as $event)
            <div class="item">
                <div class="card card-service">
                    <img src="{{ $event->image ? asset($event->image) : '' }}" alt="Latest Members" class="w-100 service_img object-fit-cover" style="height: 160px;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p class="fw-bold">13/3/2024</p>
                            <p class="fw-bold">{{ $event->event_place }}</p>
                        </div>   
                    <p class="card-text">{{ \Illuminate\Support\Str::limit($event->title, 28) }}</p>
                    </div>
                </div>
            </div>
            @endforeach            
        </div>
    </div>
   </div>
    <!-- Events -->

    <!-- News -->
    <div class="container mt-5 mb-5">
        <h3 class="fw-bold py-3">Updated News</h3>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="">
                    @if ($news->isNotEmpty())
                        <img src="{{ asset($news->first()->image) }}" alt="News Event" class="w-100" style="border-radius: 30px; height: 568px; object-fit: cover;">
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="row g-1">
                    @foreach ($news as $item)
                    <div class="col-md-12">
                        <div class="news-item text-dark p-3">
                            <div class="row justify-content-between">
                                <div class="col-md-4">
                                    <img class="w-75 rounded" src="{{ $item->image ? asset($item->image) : '' }}" alt="News Event" style="height: 130px; object-fit: cover;">
                                </div>
                                <div class="col-md-8">
                                    <a href="{{ route('frontend.news.details', $item->id) }}"><h5 class="fw-bold">{{ $item->title }}</h5></a>
                                    <p class="py-2 text-primary fw-bold">{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-2 d-flex justify-content-start ms-3">
                    <a class="btn btn-primary" href="{{ route('frontend.news.all') }}">More News <i class="bi bi-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- News -->

    <!-- gallery -->
    <div class="container-wrapper p-4" style="background: #E7EFFE">
        <div class="container mt-5 mb-5">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="fw-bold py-3">Our Gallery</h3>
    
                <!-- Filter Navigation (Right Aligned) -->
                <ul class="nav justify-content-end my-4 filter-nav p-2" style="background-color: #fff; border-radius: 5px;">
                    <li class="nav-item">
                        <a class="nav-link active" id="filter-all">All</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="filter-photos">Photos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="filter-videos">Videos</a>
                    </li>
                </ul>
            </div>
    
            <!-- Gallery Grid -->
            <div class="row row-cols-1 row-cols-md-4 g-4 gallery-grid">
                <!-- Loop through the images dynamically -->
                @foreach($images as $image)
                    <div class="col gallery-item photo">
                        <img src="{{ asset($image->image) }}" alt="Photo {{ $loop->index + 1 }}" class="img-fluid">
                    </div>
                @endforeach
    
                <!-- Loop through the videos dynamically -->
                @foreach($videos as $video)
                    <div class="col gallery-item video">
                        <div class="video-container">
                            <video>
                                <source src="{{ asset($video->video) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            <div class="play-icon"><i class="bi bi-play-circle-fill"></i></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    
    <!-- gallery -->

    <!-- Executive Committee -->
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-between mb-3">
            <h3 class="fw-bold">Executive Commitee</h3>
            <a class="btn btn-primary" href="">View All <i class="bi bi-arrow-right ms-2"></i></a>
        </div>
        <div class="row g-3">

            @foreach ($executives as $executive)
                <div class="col-md-3">
                    <div class="card">
                        <div class="position-relative">
                            <img src="{{ $executive->image ? asset($executive->image) : '' }}" alt="Photo 1" class="w-100" style="height: 200px;">
                            <div class="position-absolute top-50 end-0 translate-middle-y d-flex flex-column">
                                <a class="me-3 mb-2" href="{{ $executive->fb_link }}"><i class="bi bi-facebook facebook-icon"></i></a>
                                <a class="me-3" href="{{ $executive->linkedin_link }}"><i class="bi bi-linkedin linkedin-icon"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="fw-bold">{{  $executive->name }}</p>
                            <p class="mb-0">{{  $executive->designation }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Executive Committee -->

    <!-- ======= Clients Section ======= -->
    <div id="clients" class="container mt-5 mb-5 clients" data-aos="zoom-out">
            <h3 class="fw-bold ms-2">Our Partners</h3>
            <div class="clients-slider swiper px-3">
            <div class="swiper-wrapper align-items-center">
                @foreach ($partners as $partner)
                    <div class="swiper-slide"><img src="{{ $partner->image ? asset($partner->image) : '' }}" class="img-fluid" alt=""></div>
                @endforeach
            </div>
            </div>

    </div>
    <!-- End Clients Section -->

    <!-- Blog -->
    <div class="container-wrapper p-4" style="background: #E7EFFE">
        <div class="container mt-5 mb-5">
            <div class="d-flex justify-content-between mb-3">
            <h3 class="fw-bold">Our Blogs</h3>
            <a class="btn btn-primary" href="{{ route('frontend.blog.all') }}">View All Blogs <i class="bi bi-arrow-right ms-2"></i></a>
            </div>

            <div id="blog_carouselExample" class="owl-carousel owl-theme">
                @foreach ($blogs as $blog)
                    <div class="item">
                        <div class="card card-service">
                        <img src="{{ $blog->image ? asset($blog->image) : '' }}" alt="Latest blogs" class="img-fluid service_img" style="height: 200px">
                            <div class="card-body">
                                <!-- Format the date dynamically in DD/MM/YYYY format -->
                                <p class="fw-bold m-0 text-center">{{ \Carbon\Carbon::parse($blog->created_at)->format('d/m/Y') }}</p>
                                <hr style="opacity: .1">
                                <p class="card-text">{{ Str::limit($blog->title, 28) }}</p>
                                <hr style="opacity: .1">
                                <div class="d-flex justify-content-center">
                                <a class="text-primary fw-bold" href="{{ route('frontend.blog.details', $blog->id) }}" >View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Blog -->

</main>
  <!-- End #main -->
@endsection
