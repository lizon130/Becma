@extends('backend.include.app')
@section('title', 'Dashboard')

@section('content')

    <div class="container">
        <h2>Edit Payment Status</h2>

        <form action="{{ route('admin.payments.update', $payment->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="status">Payment Status</label>
                <select name="status" class="form-control" required>
                    <option value="pending" {{ $payment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ $payment->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="rejected" {{ $payment->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>
            

            <button type="submit" class="btn btn-primary">Update Payment</button>
        </form>
    </div>

@endsection