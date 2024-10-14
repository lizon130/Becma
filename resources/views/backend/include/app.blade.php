<!DOCTYPE html>
<html lang="en">

<head>
    {{-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> --}}
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @hasSection('title')
            @yield('title')
        @else
            {{-- Dashboard | {{ Helper::getSettings('application_name') }} --}}
        @endif
    </title>

     <!-- Summernote CSS CDN -->
     <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" rel="stylesheet">

    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/css/backend/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendor/fontawesome/css/all.min.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


    <link href="{{ asset('backend/assets/css/backend/toastr.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/css/backend/jquery.dataTables.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('backend/assets/js/backend/sweetalert2.js') }}" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/summernote/summernote.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/select2/css/select2.min.css') }}">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    {{-- <link rel="shortcut icon" href="{{ asset('uploads/settings/' . Helper::getSettings('site_favicon')) }}" /> --}}

    <script src="{{ asset('backend/assets/js/backend/jquery.min.js') }}"></script>

    @yield('css')
    @stack('css')
</head>

<body class="sb-nav-fixed">
    <div id="loader_container" class="d-none">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    @include('backend.include.topbar')
    <div id="layoutSidenav">
        @include('backend.include.sidebar')
        <div id="layoutSidenav_content">
            <main class="pt-4">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="{{ asset('backend/assets/js/backend/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('backend/assets/js/backend/toastr.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/backend/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="{{ asset('backend/assets/vendor/summernote/summernote.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/backend/validator.js') }}"></script>

    <script src="https://cdn.socket.io/4.7.2/socket.io.min.js"
        integrity="sha384-mZLF4UVrpi/QTWPA7BjNPEnkIfRFn4ZEO3Qt/HFklTJBj/gBOV8G3HcKn4NfQblz" crossorigin="anonymous">
    </script>
    <script>
        const nodeUrl = "{{ env('NODE_URL') }}";
    </script>
    <script src="{{ asset('backend/assets/js/backend/scripts.js') }}"></script>
    <!-- Summernote JS CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>

    <script>
        $(document).ajaxStart(function() {
            $('#loader_container').removeClass('d-none').addClass('d-flex');
        });
        $(document).ajaxComplete(function() {
            $('#loader_container').removeClass('d-flex').addClass('d-none');
        });
    </script>

    <script>

        function showToast(status, message) {
            if (status == 1) {
                $.toast({
                    heading: 'Success',
                    text: message,
                    position: 'top-center',
                    icon: 'success'
                })
            } else if (status == 0) {
                $.toast({
                    heading: 'Error',
                    text: message,
                    position: 'top-center',
                    icon: 'error'
                })
            }
        }
        if ("{{ session()->has('error') }}") {
            showToast(1, "{{ session()->get('error') }}");
        }
        if ("{{ session()->has('success') }}") {
            showToast(1, "{{ session()->get('success') }}");
        }

        function imagePreview(input, preview) {
            var file = $(input).get(0).files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function() {
                    $(preview).attr("src", reader.result);
                }
                reader.readAsDataURL(file);
            }
        }

        function initRichtextEditor() {
            $('.richtext').each(function() {
                if (!$(this).data('quill')) {
                    const editorId = $(this).data('name');
                    const quill = new Quill(this, {
                        theme: 'snow',
                        modules: {
                            toolbar: [
                                [{
                                    size: []
                                }],
                                ['bold', 'italic'],
                                [{
                                    'header': '1'
                                }, {
                                    'header': '2'
                                }, 'blockquote', 'link'],
                                [{
                                    'list': 'ordered'
                                }, {
                                    'list': 'bullet'
                                }],
                            ],
                        }
                    });

                    $(this).data('quill', quill);

                    quill.on('text-change', function() {
                        const hiddenInput = $(`[data-name="${editorId}"]`);
                        const content = quill.root.innerHTML;
                        const strippedContent = content.replace(/<[^>]+>/g, '').trim();
                        if (strippedContent.length === 0) {
                            hiddenInput.val('');
                        } else {
                            hiddenInput.val(content);
                        }
                    });
                }
            });
            try {
                $('.tinymceText').summernote();
            } catch (error) {
                console.log("error", error);
            }
        }
        $(document).ready(function() {
            $('.select2').select2();
            initRichtextEditor();
            $(document).on('click', '.flag-select', function(e) {
                e.preventDefault();
                let language = $(this).attr('data-language');
                $.ajax({
                    url: "{{ url('admin/setting/change-language') }}",
                    type: "Get",
                    data: {
                        language: language,
                    },
                    success: function(response) {
                        window.location.reload();
                    }
                })
            });
        });
    </script>

<script>
    $(document).on('click', '.btn-close', function() {
        // Clear the image preview
        const defaultImage = '{{ asset('backend/assets/img/gray-cover.png') }}';
        const imagePreview = $('.preview_cover');

        // Reset the image source to the default image
        imagePreview.attr('src', defaultImage);

        // Clear the file input value
        const fileInput = $('#cover_image');
        fileInput.val(''); // Clear the input value
    });

</script>

    @stack('footer')
    @yield('script')

</body>

</html>
