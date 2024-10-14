<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="createForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add News</h5>
                    <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group  row">
                        <label for="" class="text-gray-700 fw-medium col-sm-12 col-form-label">Title</label>
                        <div class="col-sm-12">
                            <input type="text" name="title" class="form-control" placeholder="Enter Title" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="text-gray-700 fw-medium col-sm-12 col-form-label">Description</label>
                        <div class="col-sm-12">
                            <textarea name="description" id="summernote" class="form-control" placeholder="Enter Description" required></textarea>
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

