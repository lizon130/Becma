@extends('backend.include.app')
@section('title', 'Dashboard')
@section('css')
<style>
    .profile_image_input--container {
        width: 100%;
        height: 200px;
        aspect-ratio: 1/1;
    }

    .cover_image {
        width: 200px;
        height: 200px;
        aspect-ratio: 16/9;
        object-fit: cover;
        background: #6463639c;
        position: relative;
        border-radius: 36px;
        overflow: hidden;
    }

    .cover_ico {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }

    .ico-no-image {
        display: block;
        background: #000000b3;
        padding: 10px;
        border-radius: 30px;
    }

    .preview_image {
        width: 110px;
        height: 110px;
        border-radius: 50%;
        border: 1px solid #f5f5f5;
    }

    .profile_image {
        position: absolute;
        top: 80px;
        left: 0;
        border-radius: 50%;
    }

    .preview_ico {
        position: absolute;
        top: 35px;
        left: 35px;
        cursor: pointer;
    }

    .preview_cover {
        object-fit: cover;
        height: 100%;
        width: 100%;
    }
</style>
@endsection
@section('content')
    <div class="container-fluid px-4">
        <h4 class="mt-2 mb-3">Executive Commitee</h4>

        <div class="card my-2">
            <div class="card-header">
                <div class="row ">
                    <div class="col-12 d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <h5 class="m-0">Executive Commitee List</h5>
                        </div>

                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#createModal"><i class="fa-solid fa-plus"></i>
                                Add</button>

                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th>Serial No.</th>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Category Committee</th>
                            <th>image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('backend.pages.executive_commitee.modal')
@endsection
@section('script')
    <script type="text/javascript">
       function getList() {
    var table = jQuery('#dataTable').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('commitee.list') }}", // Ensure this route matches your controller
            type: 'GET',
        },
        aLengthMenu: [
            [25, 50, 100, 500, 5000, -1],
            [25, 50, 100, 500, 5000, "All"]
        ],
        iDisplayLength: 25,
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            { data: 'name', name: 'name' },
            { data: 'designation', name: 'designation' },
            { data: 'committee_category', name: 'committee_category' },
            { data: 'image', name: 'image' },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                className: "text-center w-10"
            }
                ],
            });
        }
        getList();

        $(document).on('click', '#filterBtn', function(e) {
            e.preventDefault();
            let title = $('#filter_form #title').val();

            $('#dataTable').DataTable().destroy();
            getList(title, email, phone);
        })

        $(document).on('click', '#createBtn', function(e) {
        e.preventDefault();
        let go_next_step = true;
        if ($(this).attr('data-check-area') && $(this).attr('data-check-area').trim() !== '') {
            go_next_step = check_validation_Form('#createModal .' + $(this).attr('data-check-area'));
        }

    if (go_next_step == true) {
        let form = document.getElementById('createForm');
        var formData = new FormData(form);

        console.log(...formData); // Debugging: Log form data

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('commitee.store') }}",  // Ensure this route matches
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                showToast(response?.status, response?.msg);
                $('#dataTable').DataTable().destroy();
                getList();
                $('#createModal').modal('hide');
            },
            error: function(xhr) {
                let errorMessage = xhr.responseJSON?.msg || 'Something went wrong!';
                console.log(xhr);  // Log the entire response for debugging
                $('#createForm .server_side_error').html(
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                    errorMessage +
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                );
            },
        });
    }
});


        $(document).on('click', '.edit_btn', function(e) {
            e.preventDefault();
            let id = $(this).attr('data-id');
            $.ajax({
                url: "{{ route('commitee.edit') }}",
                type: "GET",
                data: {
                    id: id
                },
                dataType: "html",
                success: function(data) {
                    $('#editModal .modal-content').html(data);
                    $('#editModal').modal('show');
                    $('.select2').select2({
                        dropdownParent: $('#editForm')
                    });
                }
            })
        });

        $(document).on('click', '#editBtn', function(e) {
            e.preventDefault();
            let go_next_step = true;
            if ($(this).attr('data-check-area') && $(this).attr('data-check-area').trim() !== '') {
                go_next_step = check_validation_Form('#editModal .' + $(this).attr('data-check-area'));
            }
            if (go_next_step == true) {
                let form = document.getElementById('editForm');
                var formData = new FormData(form);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('commitee.update') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        showToast(response?.status, response?.msg);
                        $('#dataTable').DataTable().destroy();
                        getList();
                        $('#editModal').modal('hide');
                    },
                    error: function(xhr) {
                    let errorMessage = xhr.responseJSON?.msg || 'Something went wrong!';
                    console.log(xhr);  // Log the entire response to debug the issue
                    $('#createForm .server_side_error').html(
                        '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                        errorMessage +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                    );
                },

                })
            }
        })

        $(document).on('click', '.delete_btn', function(e) {
            e.preventDefault();
            let id = $(this).attr('data-id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('commitee.delete') }}",
                        data: {
                            id: id
                        },
                        type: "post",
                        dataType: "json",
                        success: function(response) {
                            showToast(response?.status, response?.msg);
                            $('#dataTable').DataTable().destroy();
                            getList();
                        }
                    })

                }
            })
        })

        $(document).ready(function() {
            $('.select2').select2({
                dropdownParent: $('#createForm')
            });
        })
    </script>

    <!-- Initialize Summernote -->
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 300,                 // Set editor height
                minHeight: 100,              // Set minimum height of editor
                maxHeight: 500,              // Set maximum height of editor
                focus: true,                 // Set focus to editable area after initializing summernote
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],  // Add font size dropdown
                    ['color', ['color']],        // Add color option
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '20', '22', '24', '28', '32', '36', '48', '64', '82', '100'],  // All font sizes
                styleTags: ['p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'blockquote', 'pre', 'div'],
                colors: [
                    // Add a wide variety of colors (or leave this as default for a smaller color set)
                    ['#f44336', '#e91e63', '#9c27b0', '#673ab7', '#3f51b5', '#2196f3', '#03a9f4', '#00bcd4', '#009688', '#4caf50', '#8bc34a', '#cddc39'],
                    ['#ffeb3b', '#ffc107', '#ff9800', '#ff5722', '#795548', '#9e9e9e', '#607d8b', '#000000', '#ffffff', 'custom-color-picker']
                ],
                callbacks: {
                    onInit: function() {
                        // Enable the color picker
                        $(".note-color-btn").attr("type", "color");
                    }
                }
            });
        });
    </script>

@endsection
