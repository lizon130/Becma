<form id="editForm">
    @csrf
    <input type="hidden" name="id" value="{{ $gallery_video->id }}">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Video</h5>
        <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
        </button>
    </div>
    <div class="modal-body">

        <div class="form-group row">
            <div class="form-group row">
                <label class="mb-2">Upload Video:</label>
                <div class="col-sm-12">
                    <input type="file" id="video" name="video" accept="video/*" required>
                </div>
            </div>

            <div class="col-sm-12 mt-2">
                @if(isset($gallery_video->video)) <!-- Check if there is an existing video -->
                    <video width="200" height="160" controls>
                        <source src="{{ asset($gallery_video->video) }}" type="video/mp4"> <!-- Use the video path -->
                        Your browser does not support the video tag.
                    </video>
                    <p>Current Video: <strong>{{ basename($gallery_video->video) }}</strong></p> <!-- Display video name -->
                @else
                    <p>No video uploaded yet.</p> <!-- Message if no video exists -->
                @endif
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
