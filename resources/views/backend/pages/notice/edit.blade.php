<form id="editForm">
    @csrf
    <input type="hidden" name="id" value="{{ $notice->id }}">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
        <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
        </button>
    </div>
    <div class="modal-body">

        <div class="form-group row">
            <label for="" class="text-gray-700 fw-medium col-sm-12 col-form-label">Title</label>
            <div class="col-sm-12">
                <input type="text" name="title" value="{{ $notice->title }}" class="form-control" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="" class="text-gray-700 fw-medium col-sm-12 col-form-label">Description</label>
            <div class="col-sm-12">
                <textarea name="description" id="summernote" class="form-control" placeholder="Enter Description" required value="{{$notice->description }}">{{$notice->description }}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="status" class="text-gray-700 fw-medium col-sm-12 col-form-label">Status</label>
            <div class="col-sm-12">
                <select name="status" class="form-control" required>
                    <!-- Dynamically select the current status from the database -->
                    <option value="published" {{ $notice->status == 'published' ? 'selected' : '' }}>Published</option>
                    <option value="unpublished" {{ $notice->status == 'unpublished' ? 'selected' : '' }}>Unpublished</option>
                </select>
            </div>
        </div>


        <div class="form-group row">
            <label for="file" class="text-gray-700 fw-medium col-sm-12 col-form-label">Upload File (Image or PDF)</label>
            <div class="col-sm-12">
                <input type="file" id="file" name="file" accept="image/*,application/pdf" onchange="imagePreview(this)">
                <img class="preview_cover mt-2" src="{{ $notice->image ? asset($notice->image) : asset('backend/assets/img/gray-cover.png') }}" alt="Preview" style="max-width: 200px; display: none;">
            </div>
        </div>

        {{-- <div class="form-group row">
            <label for="" class="text-gray-700 fw-medium col-sm-12 col-form-label">Upload Image</label>
            <div class="col-sm-12">
                <div class="profile_image_input--container position-relative">
                    <label class="cover_image" for="edit_cover_image">
                        <img class="preview_cover cursor-pointer" src="{{ $notice->image ? asset($notice->image) : asset('backend/assets/img/gray-cover.png') }}" alt="">
                        <div class="cover_ico cursor-pointer">@include('icons.no-image')</div>
                        <button type="button" class="btn-close position-absolute" style="top: 10px; right: 10px; background: rgba(0, 0, 0, 0.5); border-radius: 50%;" aria-label="Close" onclick="removeImage()">&times;</button>
                    </label>
                </div>
                <input type="file" id="edit_cover_image" name="image" class="d-none" onchange="imagePreview('#edit_cover_image', '#editForm .preview_cover')">
            </div>
        </div> --}}
        

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