@extends('backend.include.app')
@section('title', 'User | Seller Complaints')
@section('css')
    <style>
        .profile_image_input--container {
            width: 190px;
            aspect-ratio: 1/1;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid px-4">
        <h4 class="mt-2">Seller Complaints</h4>

        <div class="card my-2">
            <div class="card-header">
                <div class="row ">
                    <div class="col-12 d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <h5 class="m-0">Seller Complaints List</h5>
                        </div>

                            {{-- <button type="button" class="btn btn-primary btn-create-user create_form_btn"
                                data-bs-toggle="modal" data-bs-target="#createModal"><i class="fa-solid fa-plus"></i>
                                Add
                            </button> --}}

                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>Serial No.</th>
                            <th>Seller</th>
                            <th>Subject</th>
                            <th>File</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- @include('backend.pages.user.modal') --}}

        <!-- view Modal -->
        <div class="modal fade" id="EditPendingajaxModel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelHeading">View Complaint</h4>
                    </div>
                    <div class="modal-body">
                        <form id="userForm" name="userForm" class="form-horizontal">
                            <input type="hidden" name="user_id" id="user_id">
                            
                            {{-- <div class="form-group">
                                <label for="company_name">Seller Company Name</label>
                                <input type="text" class="form-control" id="company_name" name="company_name" readonly>
                            </div> --}}
        
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input type="text" class="form-control" id="subject" name="subject" readonly>
                            </div>
        
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="4" readonly></textarea>
                            </div>
        
                            {{-- <div class="form-group">
                                <label for="file">File</label>
                                <input type="text" class="form-control" id="file" name="file" readonly>
                            </div> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Image Modal -->
        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img id="modalImage" src="" class="w-100" alt="preview">
                    </div>
                </div>
            </div>
        </div>

        

    @push('footer')
    <script type="text/javascript">
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.complain.list') }}",
                order: [[1, 'desc']],
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'seller', name: 'seller'},
                    {data: 'subject', name: 'subject'},
                    {data: 'file', name: 'file'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            $('#createNewUser').click(function () {
                $('#saveBtn').val("create-user");
                $('#user_id').val('');
                $('#userForm').trigger("reset");
                $('#modelHeading').html("Create New User");
                $('#EditPendingajaxModel').modal('show');
            });

            $('body').on('click', '.viewUser', function () {
                    var user_id = $(this).data('id');
                    $.get("{{ route('admin.complain.index') }}" + '/' + user_id + '/edit', function (data) {
                        // Check for errors
                        if (data.error) {
                            alert(data.error);
                            return;
                        }

                        $('#modelHeading').html("View Complaint");
                        $('#EditPendingajaxModel').modal('show');

                        // Populate fields with user data
                        $('#user_id').val(data.user.id); 
                        $('#company_name').val(data.user.company_name);
                        $('#subject').val(data.user.subject);
                        
                        var descriptionText = data.user.description.replace(/(<([^>]+)>)/gi, "");  
                        $('#description').val(descriptionText);
                        $('#file').val(data.user.file);
                    }).fail(function() {
                        alert("Error retrieving user data.");
                    });
                });


                $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Saving...'); // Change button text to indicate saving

                $.ajax({
                    data: $('#userForm').serialize(), // Serialize form data
                    url: "{{ route('admin.complain.store') }}", // Use the appropriate route
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#userForm').trigger("reset"); // Reset form fields
                        $('#EditPendingajaxModel').modal('hide'); // Hide the modal
                        $('#saveBtn').html('Save'); // Reset button text
                        
                        // Reload the DataTable to reflect the changes
                        $('.data-table').DataTable().ajax.reload(null, false); // Keep pagination

                        // Display success message using Toastr
                        toastr.success('Changed successfully!'); // Show toastr success message
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Save'); // Reset button text in case of error

                        // Optionally handle validation errors
                        var errors = data.responseJSON.errors;
                        if (errors) {
                            $.each(errors, function (key, value) {
                                toastr.error(value[0]); // Show toastr error message for each field
                            });
                        }
                    }
                });
            });


            $('body').on('click', '.deleteUser', function () {
                var user_id = $(this).data("id");
                if(confirm("Are You sure want to delete !")){
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('admin.complain.destroy', '') }}" + "/" + user_id,
                        success: function (data) {
                            table.draw();
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                }
            });
        });
        
    </script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const imageModal = document.getElementById('imageModal');
        imageModal.addEventListener('show.bs.modal', function(event) {
            const anchor = event.relatedTarget; // Button that triggered the modal
            const imgSrc = anchor.getAttribute('data-img-src'); // Extract info from data-* attributes
            const modalImage = document.getElementById('modalImage');
            modalImage.src = imgSrc; // Update the modal's image source
        });
    });
</script>

<script>
    $('body').on('change', '.status-select', function () {
    var complaint_id = $(this).data('id');
    var status = $(this).val(); // Get the selected status
    var previousStatus = $(this).data('previous') || $(this).val(); // Store previous value

    // Show SweetAlert2 confirmation dialog
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you really want to change the status?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, change it!',
        cancelButtonText: 'No, keep it'
    }).then((result) => {
        if (result.isConfirmed) {
            // Proceed with AJAX request to update the status
            $.ajax({
                type: "POST",
                url: "{{ route('admin.complaints') }}", // Update with your route
                data: {
                    id: complaint_id, // Send the complaint ID
                    status: status, // Send the selected status
                    _token: $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                },
                success: function (data) {
                    if (data.success) {
                        Swal.fire(
                            'Updated!',
                            data.message,
                            'success'
                        );
                        $('.data-table').DataTable().ajax.reload(null, false); // Refresh the DataTable
                    } else {
                        Swal.fire('Error', data.message, 'error'); // Display error message if any
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                    Swal.fire('Error', 'An error occurred while updating the status.', 'error'); // Display generic error message
                }
            });
        } else {
            // If "No" is clicked, revert the select dropdown to the previous value
            $('.status-select[data-id="' + complaint_id + '"]').val(previousStatus);
        }
    });

    // Store the previous status for future comparison
    $(this).data('previous', previousStatus);
});
 
</script>
    

    @endpush
@endsection
