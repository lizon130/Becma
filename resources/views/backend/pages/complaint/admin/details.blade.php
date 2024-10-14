<!-- Modal -->
<div class="modal fade" id="complaintModal" tabindex="-1" aria-labelledby="complaintModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="complaintModalLabel">Complaint Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Modal body where the complaint details will be displayed -->
          <table class="table table-bordered">
            <tr>
              <th>Company Name</th>
              <td id="companyName"></td>
            </tr>
            <tr>
              <th>Subject</th>
              <td id="subject"></td>
            </tr>
            <tr>
              <th>File</th>
              <td id="filePreview"></td>
            </tr>
            <tr>
              <th>Status</th>
              <td id="status"></td>
            </tr>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  