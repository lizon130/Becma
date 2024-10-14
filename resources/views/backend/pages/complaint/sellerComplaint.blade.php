@extends('backend.include.app')
@section('title', 'Complaint')

@section('content')
<div class="container">
    <h2>Your Complaints</h2>
    <form action="{{ route('seller.complaint.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" name="subject" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit Complaint</button>
    </form>

    <h3>Your Complaint List</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Subject</th>
                <th>Description</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($complaints as $complaint)
                <tr>
                    <td>{{ $complaint->subject }}</td>
                    <td>{{ $complaint->description }}</td>
                    <td>{{ $complaint->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
