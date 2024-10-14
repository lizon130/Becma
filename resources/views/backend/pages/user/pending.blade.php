@extends('backend.include.app')
@section('title', 'User | Pending Members')
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
        <h4 class="mt-2">Pending Members</h4>

        <div class="card my-2">
            <div class="card-header">
                <div class="row ">
                    <div class="col-12 d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <h5 class="m-0">Pending Members List</h5>
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
                            <th>Company Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th width="150px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- @include('backend.pages.user.modal') --}}

        <!-- Pending Modal -->
        <div class="modal fade" id="EditPendingajaxModel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelHeading"></h4>
                    </div>
                    <div class="modal-body">
                        <form id="userForm" name="userForm" class="form-horizontal">
                            <input type="hidden" name="user_id" id="user_id">
                            <div class="form-group">
                                <label for="name">Company Name</label>
                                <input type="text" class="form-control" id="company_name" name="company_name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="email">Phone</label>
                                <input type="email" class="form-control" id="mobile" name="mobile">
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select id="status" name="status" class="form-control">
                                    <!-- Options will be populated dynamically -->
                                </select>
                            </div>

                             <button type="submit" class="btn btn-primary" id="saveBtn">Submit</button>
                        </form>
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
                ajax: "{{ route('users.list') }}",
                order: [[1, 'desc']],
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'company_name', name: 'company_name'},
                    {data: 'email', name: 'email'},
                    {data: 'mobile', name: 'mobile'},
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

            $('body').on('click', '.editUser', function () {
            var user_id = $(this).data('id');
            $.get("{{ route('users.index') }}" + '/' + user_id + '/edit', function (data) {
                // Check for errors
                if (data.error) {
                    alert(data.error);
                    return;
                }

                $('#modelHeading').html("Edit Member");
                $('#saveBtn').val("edit-user");
                $('#EditPendingajaxModel').modal('show');

                // Populate fields with user data
                $('#user_id').val(data.user.id); // Ensure this is the correct ID input
                $('#company_name').val(data.user.company_name);
                $('#email').val(data.user.email);
                $('#mobile').val(data.user.mobile);

                // Clear previous options and populate the status dropdown
                $('#status').empty();
                $.each(data.statuses, function(index, value) {
                    var selected = (value === data.user.status) ? 'selected' : ''; // Check if it's the current status
                    $('#status').append('<option value="' + value + '" ' + selected + '>' + value.charAt(0).toUpperCase() + value.slice(1) + '</option>');
                });
            }).fail(function() {
                alert("Error retrieving user data.");
            });
        });


                $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Saving...'); // Change button text to indicate saving

                $.ajax({
                    data: $('#userForm').serialize(), // Serialize form data
                    url: "{{ route('users.store') }}", // Use the appropriate route
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
                        url: "{{ route('users.destroy', '') }}" + "/" + user_id,
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
    @endpush
@endsection
