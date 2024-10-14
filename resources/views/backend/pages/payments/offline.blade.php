@extends('backend.include.app')
@section('title', 'Dashboard')

@section('content')
<div class="container">
    <h2>Offline Payment</h2>
    <form action="{{ route('seller.payments.submitOffline') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="payment_method">Payment Method</label>
            <select name="payment_method" class="form-control" required>
                <option value="Bank Transfer">Bank Transfer</option>
                <option value="Cash">Cash</option>
            </select>
        </div>

        <div class="form-group">
            <label for="payment_details">Payment Details</label>
            <textarea name="payment_details" class="form-control" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit Payment</button>
    </form>
</div>
@endsection

