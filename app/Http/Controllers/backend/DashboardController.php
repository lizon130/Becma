<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\DataTables;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch all users
        $users = User::latest()->get();

        // Count users by status
        $activeMembersCount = $users->where('status', 'accepted')->count();
        $pendingMembersCount = $users->where('status', 'pending')->count();
        $rejectedMembersCount = $users->where('status', 'rejected')->count();

        // Pass the counts to the view
        return view('backend.pages.dashboard', compact('activeMembersCount', 'pendingMembersCount', 'rejectedMembersCount'));
    }
    public function getUsers(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('id', 'company_name', 'email', 'mobile', 'status')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    // Define the button class based on the status
                    $statusClass = '';

                    if ($row->status === 'pending') {
                        $statusClass = 'btn-info'; // Blue color for pending
                    } elseif ($row->status === 'accepted') {
                        $statusClass = 'btn-success'; // Green color for accepted
                    } elseif ($row->status === 'rejected') {
                        $statusClass = 'btn-danger'; // Red color for rejected
                    }

                    // Return the button with the dynamic class
                    return '<button class="btn ' . $statusClass . ' btn-sm">' . ucfirst($row->status) . '</button>';
                })
                ->rawColumns(['status'])
                ->make(true);
        }

        // Optionally handle non-Ajax requests
        return response()->json(['error' => 'Invalid request'], 400);
    }

    

}
