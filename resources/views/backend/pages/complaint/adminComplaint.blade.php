@extends('backend.include.app')
@section('title', 'Complaint')

@section('content')
<div class="container">
    <h2>All Complaints</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Seller</th>
                <th>Subject</th>
                <th>Description</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($complaints as $complaint)
                <tr>
                    <td>{{ $complaint->seller->company_name }}</td>
                    <td>{{ $complaint->subject }}</td>
                    <td>{!! $complaint->description !!}</td>
                    <td>
                        <select class="status-dropdown" data-id="{{ $complaint->id }}">
                            <option value="pending" {{ $complaint->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $complaint->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="finished" {{ $complaint->status == 'finished' ? 'selected' : '' }}>Finished</option>
                        </select>
                    </td>
                    <td><button class="btn btn-success update-status" data-id="{{ $complaint->id }}">Update Status</button></td>                    
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).on('click', '.update-status', function() {
        var complaintId = $(this).data('id');
        var status = $('.status-dropdown[data-id="'+complaintId+'"]').val();

        $.ajax({
            url: '/admin/complaint/update/' + complaintId,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                status: status
            },
            success: function(response) {
                if(response.success) {
                    alert('Status updated successfully');
                } else {
                    alert('Failed to update status: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', xhr.responseText);
                alert('An error occurred: ' + xhr.responseText);
            }
        });
    });
</script>

@endsection
