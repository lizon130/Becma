<form id="editForm">
    @csrf
    <input type="hidden" name="id" value="{{ $partner->id }}">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
        <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
        </button>
    </div>
    <div class="modal-body">

        <div class="form-group row">
            <label for="" class="text-gray-700 fw-medium col-sm-12 col-form-label">Upload Image</label>
            <div class="col-sm-12">
                <div class="profile_image_input--container position-relative">
                    <label class="cover_image" for="edit_cover_image">
                        <img class="preview_cover cursor-pointer" src="{{ $partner->image ? asset($partner->image) : asset('backend/assets/img/gray-cover.png') }}" alt="">
                        <div class="cover_ico cursor-pointer">@include('icons.no-image')</div>
                    </label>
                </div>
                <input type="file" id="edit_cover_image" name="image" class="d-none" onchange="imagePreview('#edit_cover_image', '#editForm .preview_cover')">
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
