@extends('backend.include.app')
@section('title', 'Dashboard')
@section('css')
    <style>
        .dashboard-card-amount {
            font-size: 32px;
        }
        h5 {
            white-space: nowrap;
            font-size: 16px;
        }
         .row{
            flex-wrap: nowrap !important;
         }
    </style>
@endsection
@section('content')
    <div class="container-fluid px-5 pt-4"> 

    {{-- Admin     --}}
        @if(auth()->check() && auth()->user()->hasRole('admin'))

        <div class="alert alert-info text-center">
            <h4>Welcome to the Admin Dashboard, <span class="fw-bold">{{ auth()->user()->company_name }}!</span></h4>
        </div>

            <div class="d-flex justify-content-center py-5">
                <div class="bg-dark text-white p-2 rounded-3 w-25 d-flex flex-column justify-content-center align-items-center" style="padding: 100px !important">
                    <h5 class="font-bold fs-4">Active Members</h5>
                    <h2 class="text-primary fs-2">{{ $activeMembersCount }}</h2>
                </div>
                <div class="bg-dark text-white p-2 rounded-3 ms-3 w-25 d-flex flex-column justify-content-center align-items-center" style="padding: 100px !important">
                    <h5 class="font-bold fs-4">Pending Members</h5>
                    <h2 class="text-primary fs-2">{{ $pendingMembersCount }}</h2>
                </div>
                <div class="bg-dark text-white p-2 rounded-3 ms-3 w-25 d-flex flex-column justify-content-center align-items-center" style="padding: 100px !important">
                    <h5 class="font-bold fs-4">Rejected Members</h5>
                    <h2 class="text-primary fs-2">{{ $rejectedMembersCount }}</h2>
                </div>
            </div>
        @endif
        {{-- @endif --}}

        {{-- @if(auth()->check() && auth()->user()->hasRole('admin'))   
            <div class="card my-2">
                <div class="card-header">
                    <div class="row ">
                        <div class="col-12 d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <h5 class="m-0">All User List</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Company Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        @endif --}}
        {{-- @endif --}}
    {{-- Admin     --}}

    @if(auth()->check() && auth()->user()->hasRole('seller'))
        <div class="alert alert-info text-center">
            <h4>Welcome to the Seller Dashboard, <span class="fw-bold">{{ auth()->user()->company_name }}!</span></h4>
        </div>

        <div class="card-body">
            <table class="table table-borderless">
                <tbody class="p-3">
                    <tr>
                        <td><strong>Company Name</strong></td>
                        <td>: {{ auth()->user()->company_name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Email</strong></td>
                        <td>: {{ auth()->user()->email }}</td>
                    </tr>
                    
                    <tr>
                        <td><strong>Contact No</strong></td>
                        <td>: {{ auth()->user()->mobile }}</td>
                    </tr>
                    <tr>
                        <td><strong>E-mail</strong></td>
                        <td>: {{ auth()->user()->email }}</td>
                    </tr>
                    <tr>
                        <td><strong>Status</strong></td>
                        <td>: {{ auth()->user()->status }}</td>
                    </tr>
                </tbody>
            </table>
        </div>



    @endif
        
    </div>
@endsection
@section('script')

<script type="text/javascript">
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('dashboard.list') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'company_name', name: 'company_name'},
                {data: 'email', name: 'email'},
                {data: 'mobile', name: 'mobile'},
                {data: 'status', name: 'status'},
            ]
        });
    });
</script>

@endsection
