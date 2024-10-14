<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Becma</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ Helper::getSettings('site_favicon') ? asset('uploads/settings/' . Helper::getSettings('site_favicon')) : asset('assets/img/favicon.png') }}" rel="icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
  <!-- Owl Carousel CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
</head>

<body>
  <!-- ======= Header ======= -->
  <section id="topbar" class="topbar d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center">
          <a href="mailto:{{ Helper::getSettings('application_email') ? Helper::getSettings('application_email') : 'contact@example.com' }}">
              {{ Helper::getSettings('application_email') ? Helper::getSettings('application_email') : 'contact@example.com' }}
          </a>
      </i>

      <i class="bi bi-phone d-flex align-items-center ms-4">
        <span>{{ Helper::getSettings('application_phone') ? Helper::getSettings('application_phone') : '01844696010' }}</span>
      </i>

      {{-- <i class="bi bi-clock-history align-items-center ms-4">
        <span>{{ Helper::getSettings('application_phone') ? Helper::getSettings('application_phone') : '01844696010' }}</span>
      </i> --}}
  
      </div>
      <div class="social-links d-none d-md-flex align-items-center">
        
        <a href="{{ Helper::getSettings('twitter_link') && filter_var(Helper::getSettings('twitter_link'), FILTER_VALIDATE_URL) ? Helper::getSettings('twitter_link') : asset('uploads/settings/' . Helper::getSettings('twitter_link')) }}" class="twitter">
          <i class="bi bi-twitter"></i>
        </a>

        <a href="{{ Helper::getSettings('facebook_link') && filter_var(Helper::getSettings('facebook_link'), FILTER_VALIDATE_URL) ? Helper::getSettings('facebook_link') : asset('uploads/settings/' . Helper::getSettings('facebook_link')) }}" class="facebook">
          <i class="bi bi-facebook"></i>
        </a>

        <a href="{{ Helper::getSettings('youtube_link') && filter_var(Helper::getSettings('youtube_link'), FILTER_VALIDATE_URL) ? Helper::getSettings('youtube_link') : asset('uploads/settings/' . Helper::getSettings('youtube_link')) }}" class="youtube"><i class="bi bi-youtube"></i></a>

        <a href="{{ Helper::getSettings('linkedin_link') && filter_var(Helper::getSettings('linkedin_link'), FILTER_VALIDATE_URL) ? Helper::getSettings('linkedin_link') : asset('uploads/settings/' . Helper::getSettings('linkedin_link')) }}" class="linkedin"><i class="bi bi-linkedin"></i></i></a>

        <a class="fw-bold text-white" href="{{ route('frontend.login') }}"> <i class="bi bi-box-arrow-in-right me-2"></i>Member Login</a>
      </div>
    </div>
  </section>

  <header id="header" class="header d-flex align-items-center">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="{{ url('/') }}" class="logo d-flex align-items-center">
        <img src="{{ Helper::getSettings('site_logo') ? asset('uploads/settings/' . Helper::getSettings('site_logo')) : asset('assets/img/no-img.jpg') }}">
      </a>
      
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="#hero">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#portfolio">Portfolio</a></li>
          <li><a href="#team">Team</a></li>
          <li><a href="blog.html">Blog</a></li>
          <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
            </ul>
          </li>
          <li><a href="#contact">Contact</a></li>
        </ul>
        <div class="ms-3">
          <a class="btn btn-primary py-1 text-white" href="{{ route('frontend.registration') }}"><i class="bi bi-person-lines-fill me-2"></i> To Be a Member</a>
        </div>
      </nav>

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list text-dark"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x text-dark"></i>

    </div>
  </header>
  <!-- End Header -->

@yield('content')

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="container mb-4">
      <div class="row mb-4 justify-content-around">
        <div class="col-md-4 social-links">
          <div class="row mt-3">
            <div class="col-md-2">
              <a style="font-size: 20px;" href=""><i class="bi bi-telephone-fill text-light"></i></a>
            </div>
            <div class="col-md-10">
              <p>Contact Number</p>
              {{ Helper::getSettings('application_phone') ? Helper::getSettings('application_phone') : '01844696010' }}
            </div>
          </div>
        </div>
        <div class="col-md-4 social-links">
          <div class="row mt-3">
            <div class="col-md-2">
              <a style="font-size: 20px;" href=""><i class="bi bi-envelope-fill text-light"></i></a>
            </div>
            <div class="col-md-10">
              <p>Email Address</p>
              <p>{{ Helper::getSettings('application_email') ? Helper::getSettings('application_email') : 'contact@example.com' }}</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 social-links">
          <div class="row mt-3">
            <div class="col-md-2">
              <a style="font-size: 20px;" href=""><i class="bi bi-geo-alt-fill"></i></a>
            </div>
            <div class="col-md-10">
              <p>Location</p>
              <p>{{ Helper::getSettings('application_address') ? Helper::getSettings('application_address') : 'Becma Office' }}</p>
            </div>
        </div>
      </div>
    </div>

    <div class="container" style="background-color: #20314f; border-radius: 23px;">
      <div class="row gy-4 p-4">
        <div class="col-lg-5 col-md-12 footer-info">
          <a href="#" class="d-flex align-items-center">
            <img class="w-50" src="{{ asset('assets/img/logo.png') }}">
          </a>
          <p>Bangladesh E-Commerce Merchant Association (Becma).</p>
          <div class="social-links d-flex mt-4">
            <a href="{{ Helper::getSettings('twitter_link') && filter_var(Helper::getSettings('twitter_link'), FILTER_VALIDATE_URL) ? Helper::getSettings('twitter_link') : asset('uploads/settings/' . Helper::getSettings('twitter_link')) }}" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="{{ Helper::getSettings('facebook_link') && filter_var(Helper::getSettings('facebook_link'), FILTER_VALIDATE_URL) ? Helper::getSettings('facebook_link') : asset('uploads/settings/' . Helper::getSettings('facebook_link')) }}" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="{{ Helper::getSettings('youtube_link') && filter_var(Helper::getSettings('youtube_link'), FILTER_VALIDATE_URL) ? Helper::getSettings('youtube_link') : asset('uploads/settings/' . Helper::getSettings('youtube_link')) }}" class="youtube"><i class="bi bi-youtube"></i></a>
            <a href="{{ Helper::getSettings('linkedin_link') && filter_var(Helper::getSettings('linkedin_link'), FILTER_VALIDATE_URL) ? Helper::getSettings('linkedin_link') : asset('uploads/settings/' . Helper::getSettings('linkedin_link')) }}" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="#">About us</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Terms of service</a></li>
            <li><a href="#">Blog</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="#">Payment Service</a></li>
            <li><a href="#">Courier Service</a></li>
            <li><a href="#">Plastic Card</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Our Newsletter</h4>
          <div class="subscribe-section">
            <p>Subscribe for daily updates</p>
            <div class="d-flex justify-content-center">
              <input type="email" class="form-control subscribeInput custom-input" placeholder="Enter your email">
              <button class="btn btn-subscribe">Subscribe</button>
            </div>
          </div>

        </div>
      </div>
      <div class="">
        <img src="assets/img/ssl.png" alt="Photo 1" class="w-100">
      </div>
      
    </div>

    <div class="container mt-5">
      <div class="copyright">
        &copy; Copyright <strong><span>Becma</span></strong>. All Rights Reserved | Developed by <a class="text-white fw-bold" href="https://nexkraft.com/">NexKraft</a>
      </div>
    </div>
  </footer>
  <!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>
  <!-- jQuery (Owl Carousel Dependency) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <!-- Owl Carousel JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script>
    $(document).ready(function(){
      $("#service_carouselExample").owlCarousel({
        loop: true,
        margin: 15,
        nav: true,
        navText: [
          '<i class="bi bi-arrow-left-circle-fill" style="color: #0c5df1; font-size: 30px;"></i>',
          '<i class="bi bi-arrow-right-circle-fill" style="color: #0c5df1; font-size: 30px;"></i>'
        ],
        dots: false,
        responsive: {
          0: {
            items: 1
          },
          600: {
            items: 2
          },
          1000: {
            items: 4
          }
        }
      });
    });
  </script>

  <script>
    $(document).ready(function(){
      $("#blog_carouselExample").owlCarousel({
        loop: true,
        margin: 15,
        nav: true,
        navText: [
          '<i class="bi bi-arrow-left-circle-fill" style="color: #0c5df1; font-size: 30px;"></i>',
          '<i class="bi bi-arrow-right-circle-fill" style="color: #0c5df1; font-size: 30px;"></i>'
        ],
        dots: false,
        responsive: {
          0: {
            items: 1
          },
          600: {
            items: 2
          },
          1000: {
            items: 4
          }
        }
      });
    });
  </script>

  <script>
    $(document).ready(function(){
      $("#event_carouselExample").owlCarousel({
        loop: true,
        margin: 15,
        nav: true,
        navText: [
          '<i class="bi bi-arrow-left-circle-fill" style="color: #0c5df1; font-size: 30px;"></i>',
          '<i class="bi bi-arrow-right-circle-fill" style="color: #0c5df1; font-size: 30px;"></i>'
        ],
        dots: false,
        responsive: {
          0: {
            items: 1
          },
          600: {
            items: 2
          },
          1000: {
            items: 4
          }
        }
      });
    });
  </script>


<!-- Gallery -->
<script>
    // Filter functionality
    document.getElementById('filter-all').addEventListener('click', function() {
        showGalleryItems('all');
        setActive(this);
    });

    document.getElementById('filter-photos').addEventListener('click', function() {
        showGalleryItems('photo');
        setActive(this);
    });

    document.getElementById('filter-videos').addEventListener('click', function() {
        showGalleryItems('video');
        setActive(this);
    });

    function showGalleryItems(type) {
        var items = document.getElementsByClassName('gallery-item');
        for (var i = 0; i < items.length; i++) {
            items[i].style.display = 'none';
            if (type === 'all' || items[i].classList.contains(type)) {
                items[i].style.display = 'block';
            }
        }
    }

    function setActive(element) {
        var links = document.getElementsByClassName('nav-link');
        for (var i = 0; i < links.length; i++) {
            links[i].classList.remove('active');
        }
        element.classList.add('active');
    }

    // Video Play/Pause functionality
    document.querySelectorAll('.video-container').forEach(function(container) {
        var video = container.querySelector('video');
        var playIcon = container.querySelector('.play-icon');

        // Play or pause the video when the play icon or video is clicked
        playIcon.addEventListener('click', togglePlayPause);
        video.addEventListener('click', togglePlayPause);

        function togglePlayPause() {
            if (video.paused) {
                video.play();
                container.classList.remove('paused');
            } else {
                video.pause();
                container.classList.add('paused');
            }
        }

        // Show the play icon when the video is paused or ends
        video.addEventListener('pause', function() {
            container.classList.add('paused');
        });

        video.addEventListener('ended', function() {
            container.classList.add('paused');
        });

        // Initially, show the play icon
        container.classList.add('paused');
    });

    // Show all items by default on page load
    showGalleryItems('all');
</script>
  

</body>

</html>