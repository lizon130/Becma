<form id="editForm">
    @csrf
    <input type="hidden" name="id" value="{{ $executive->id }}">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Member</h5>
        <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
        </button>
    </div>
    <div class="modal-body">

        <div class="form-group row">
            <label for="" class="text-gray-700 fw-medium col-sm-12 col-form-label">Title</label>
            <div class="col-sm-12">
                <input type="text" name="name" value="{{ $executive->name }}" class="form-control" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="" class="text-gray-700 fw-medium col-sm-12 col-form-label">Designation</label>
            <div class="col-sm-12">
                <input type="text" name="designation" value="{{ $executive->designation }}" class="form-control" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="" class="text-gray-700 fw-medium col-sm-12 col-form-label">Upload Image</label>
            <div class="col-sm-12">
                <div class="profile_image_input--container position-relative">
                    <label class="cover_image" for="edit_cover_image">
                        <img class="preview_cover cursor-pointer" src="{{ $executive->image ? asset($executive->image) : asset('backend/assets/img/gray-cover.png') }}" alt="">
                        <div class="cover_ico cursor-pointer">@include('icons.no-image')</div>
                        <button type="button" class="btn-close position-absolute" style="top: 10px; right: 10px; background: rgba(0, 0, 0, 0.5); border-radius: 50%;" aria-label="Close" onclick="removeImage()">&times;</button>
                    </label>
                </div>
                <input type="file" id="edit_cover_image" name="image" class="d-none" onchange="imagePreview('#edit_cover_image', '#editForm .preview_cover')">
            </div>
        </div>

        <div class="form-group  row">
            <label for="" class="text-gray-700 fw-medium col-sm-12 col-form-label">Enter FB Link</label>
            <div class="col-sm-12">
                <input type="text" name="fb_link" class="form-control"  value="{{ $executive->fb_link }}" placeholder="Enter FB Link" required>
            </div>
        </div>

        <div class="form-group  row">
            <label for="" class="text-gray-700 fw-medium col-sm-12 col-form-label">Enter Linkedin Link</label>
            <div class="col-sm-12">
                <input type="text" name="linkedin_link" class="form-control"  value="{{ $executive->linkedin_link }}" placeholder="Enter Linkedin Link" required>
            </div>
        </div>

        <!-- Category Selection -->
        <div class="form-group row">
            <label for="" class="text-gray-700 fw-medium col-sm-12 col-form-label">Category</label>
            <div class="col-sm-12">
                <select name="committee_category" class="form-control" required>
                    <option value="">Select Category</option>
                    <option value="running_committee" {{ $executive->committee_category == 'running_committee' ? 'selected' : '' }}>
                        Running Committee
                    </option>
                    <option value="funders_committee" {{ $executive->committee_category == 'funders_committee' ? 'selected' : '' }}>
                        Funders Committee
                    </option>
                    <option value="advisory_committee" {{ $executive->committee_category == 'advisory_committee' ? 'selected' : '' }}>
                        Advisory Committee
                    </option>
                    <option value="previous_committee" {{ $executive->committee_category == 'previous_committee' ? 'selected' : '' }}>
                        Previous Committee
                    </option>
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
        <button type="submit" id="editBtn" class="btn btn-primary" data-check-area="modal-body">Update</button>
    </div>
</form>
