@extends('backend.include.app')
@section('title', 'Notices | ' . Helper::getSettings('application_name') ?? 'Becma' )
@section('content')
    <div class="container-fluid px-4">
        <h4 class="mt-2 fs-1">Latest Notice</h4>
        <div class="row">
            <!-- Latest Notice -->
            <div class="col-md-8">
                @if($latestNotice)
                    <div class="card">
                        <div class="card-header">
                            <h2>{{ $latestNotice->title }}</h2>
                        </div>
                        <div class="card-body">
                            <p>{!! $latestNotice->description !!}</p>
                            <p>{{ $latestNotice->body }}</p>

                            @if ($latestNotice->file)
                                @php
                                    $fileExtension = pathinfo($latestNotice->file, PATHINFO_EXTENSION);
                                @endphp

                                @if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']))
                                    <div class="mb-3">
                                        <img src="{{ asset($latestNotice->file) }}" alt="Notice Image" class="img-fluid">
                                    </div>
                                @elseif (strtolower($fileExtension) == 'pdf')
                                    <div class="mb-3 mt-3">
                                        <a href="{{ route('notice.viewPdf', $latestNotice->id) }}" class="btn btn-primary" target="_blank">View PDF</a>
                                    </div>
                                @else
                                    <p>Unsupported file type.</p>
                                @endif
                            @endif

                            <p class="text-muted">Posted on: {{ $latestNotice->created_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                @else
                    <p>No latest notice available.</p>
                @endif
            </div>

            <!-- Previous Notices Sidebar -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Previous Notices</h4>
                    </div>
                    <ul class="list-group list-group-flush">
                        @forelse ($previousNotices as $notice)
                            <li class="list-group-item">
                                <a href="{{ route('notices.show', $notice->id) }}">{{ $notice->title }}</a>
                            </li>
                        @empty
                            <li class="list-group-item">No previous notices.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
