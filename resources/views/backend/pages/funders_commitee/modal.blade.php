<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="createForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Member</h5>
                    <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group  row">
                        <label for="" class="text-gray-700 fw-medium col-sm-12 col-form-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" name="name" class="form-control" placeholder="Enter name" required>
                        </div>
                    </div>

                    <div class="form-group  row">
                        <label for="" class="text-gray-700 fw-medium col-sm-12 col-form-label">Designation</label>
                        <div class="col-sm-12">
                            <input type="text" name="designation" class="form-control" placeholder="Enter designation" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="text-gray-700 fw-medium col-sm-12 col-form-label">Upload Image</label>
                        <div class="col-sm-12">
                            <div class="profile_image_input--container position-relative">
                                <label class="cover_image" for="cover_image">
                                    <img class="preview_cover cursor-pointer" src="{{ asset('backend/assets/img/gray-cover.png') }}" alt="">
                                    <div class="cover_ico cursor-pointer">@include('icons.no-image')</div>
                                </label>
                            </div>
                            <input type="file" id="cover_image" name="image" class="d-none" onchange="imagePreview('#cover_image', '.preview_cover')" required>
                        </div>
                    </div>
                    

                    <div class="form-group  row">
                        <label for="" class="text-gray-700 fw-medium col-sm-12 col-form-label">Enter FB Link</label>
                        <div class="col-sm-12">
                            <input type="text" name="fb_link" class="form-control" placeholder="Enter FB Link" required>
                        </div>
                    </div>

                    <div class="form-group  row">
                        <label for="" class="text-gray-700 fw-medium col-sm-12 col-form-label">Enter Linkedin Link</label>
                        <div class="col-sm-12">
                            <input type="text" name="linkedin_link" class="form-control" placeholder="Enter Linkedin Link" required>
                        </div>
                    </div>

                    <!-- Category Selection -->
                    <div class="form-group row">
                        <label for="" class="text-gray-700 fw-medium col-sm-12 col-form-label">Category</label>
                        <div class="col-sm-12">
                            <select name="committee_category" class="form-control" required>
                                <option value="">Select Category</option>
                                <option value="running_committee">Running Committee</option>
                                <option value="funders_committee">Funders Committee</option>
                                <option value="advisory_committee">Advisory Committee</option>
                                <option value="previous_committee">Previous Committee</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="server_side_error" role="alert">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a type="button" class="modal__btn_space" data-bs-dismiss="modal">Close</a>
                    <button type="submit" id="createBtn" class="btn btn-primary"
                        data-check-area="modal-body">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- edit modal  --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">

        </div>
    </div>
</div>
