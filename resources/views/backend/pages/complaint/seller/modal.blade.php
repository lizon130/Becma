<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="createForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Complaint</h5>
                    <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group  row">
                        <label for="" class="text-gray-700 fw-medium col-sm-12 col-form-label">Complaint Subject</label>
                        <div class="col-sm-12">
                            <input type="text" name="subject" class="form-control" placeholder="Enter subject" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="text-gray-700 fw-medium col-sm-12 col-form-label">Description</label>
                        <div class="col-sm-12">
                            <textarea name="description" id="summernote" class="form-control" placeholder="Enter Description" required></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="file" class="text-gray-700 fw-medium col-sm-12 col-form-label">Upload File (Image or PDF)</label>
                        <div class="col-sm-12">
                            <input type="file" id="file" name="file" accept="image/*,application/pdf" onchange="imagePreview(this)" required>
                            <img class="preview_cover mt-2" src="{{ asset('backend/assets/img/gray-cover.png') }}" alt="Preview" style="max-width: 200px; display: none;">
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
