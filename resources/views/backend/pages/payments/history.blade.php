@extends('backend.include.app')
@section('title', 'Dashboard')

@section('content')
<div class="container">
    <h2>Payment History</h2>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Payment Method</th>
                <th>Payment Details</th>
                <th>Status</th>
                <th>Submitted At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
            <tr>
                <td>{{ $payment->id }}</td>
                <td>{{ $payment->payment_method }}</td>
                <td>{{ $payment->payment_details }}</td>
                <td>{{ $payment->status }}</td>
                <td>{{ $payment->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

