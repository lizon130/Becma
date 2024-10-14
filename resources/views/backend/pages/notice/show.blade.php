@extends('backend.include.app')
@section('title', 'Notice Details | ' . Helper::getSettings('application_name') ?? 'Becma' )
@section('content')
    <div class="container-fluid px-4">
        <h4 class="mt-2">Notice Details</h4>
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h2>{{ $notice->title }}</h2>
                </div>
                <div class="card-body">
                    <p>{!! $notice->description !!}</p>
                    <p>{{ $notice->body }}</p>

                    @if ($notice->file)
                        @php
                            $fileExtension = pathinfo($notice->file, PATHINFO_EXTENSION);
                        @endphp

                        @if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']))
                            <div class="mb-3 d-flex justify-content-center">
                                <img src="{{ asset($notice->file) }}" alt="Notice Image" class="w-75">
                            </div>
                        @elseif (strtolower($fileExtension) == 'pdf')
                            <div class="mb-3 mt-3">
                                <a href="{{ route('notice.viewPdf', $notice->id) }}" class="btn btn-primary" target="_blank">View PDF</a>
                            </div>
                        @else
                            <p>Unsupported file type.</p>
                        @endif
                    @endif

                    <p class="text-muted">Posted on: {{ $notice->created_at->format('M d, Y H:i') }}</p>
                </div>
            </div>
            <a href="{{ url()->previous() }}" class="btn btn-primary mt-3">Back</a>
        </div>
    </div>
@endsection
