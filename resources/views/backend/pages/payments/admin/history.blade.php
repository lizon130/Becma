@extends('backend.include.app')
@section('title', 'Dashboard')

@section('content')
<div class="container">
    <h2>Seller Payment History</h2>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Seller</th>
                <th>Payment Method</th>
                <th>Payment Details</th>
                <th>Status</th>
                <th>Submitted At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
            <tr>
                <td>{{ $payment->id }}</td>
                <td>{{ $payment->seller->company_name }}</td>
                <td>{{ $payment->payment_method }}</td>
                <td>{{ $payment->payment_details }}</td>
                <td>{{ $payment->status }}</td>
                <td>{{ $payment->created_at }}</td>
                <td>
                    <a href="{{ route('admin.payments.edit', $payment->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.payments.delete', $payment->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this payment record?');">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

