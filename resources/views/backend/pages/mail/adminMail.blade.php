@extends('backend.include.app')
@section('title', 'Dashboard')
@section('css')

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0 text-black">Send Mail to Sellers</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.mail.send') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" name="subject" class="form-control" id="subject" placeholder="Enter email subject" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea name="message" class="form-control" id="message" rows="4" placeholder="Enter your message here" required></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="recipient" class="form-label">Send To</label>
                            <select name="recipient" class="form-control" id="recipient" required>
                                <option value="all">All Sellers</option>
                                @foreach($sellers as $seller)
                                    <option value="{{ $seller->email }}">{{ $seller->company_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">Send Mail</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
