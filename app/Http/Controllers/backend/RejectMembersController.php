<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;


class RejectMembersController extends Controller
{
    public function index()
    {
        return view('backend.pages.user.reject_member');
    }

    public function getUsers(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('id', 'company_name', 'email', 'mobile', 'status')
                    ->where('status', 'rejected')
                    ->orderBy('updated_at', 'DESC')
                    ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    // Define the button class based on the status
                    $statusClass = '';
                    
                    if ($row->status === 'pending') {
                        $statusClass = 'badge rounded-pill text-bg-warning'; // Blue color for pending
                    } elseif ($row->status === 'accepted') {
                        $statusClass = 'badge rounded-pill text-bg-success'; // Green color for accepted
                    } elseif ($row->status === 'rejected') {
                        $statusClass = 'badge rounded-pill text-bg-danger'; // Red color for rejected
                    }
                    
                    // Return the button with the dynamic class
                    return '<button class="btn ' . $statusClass . ' btn-sm">' . ucfirst($row->status) . '</button>';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="edit btn btn-primary btn-sm editUser">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" data-id="'.$row->id.'" class="delete btn btn-danger btn-sm deleteUser">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
    }

    public function store(Request $request)
{
    // Validate the input data
    $request->validate([
        'company_name' => 'required',
        'email' => 'required|email|unique:users,email,' . $request->user_id, // Allow the current email for updates
        'mobile' => 'required',
        'status' => 'required',
    ]);

    // Use firstOrNew to get an existing user or create a new instance without saving it yet
    $user = User::firstOrNew(
        ['id' => $request->user_id] // Check if user_id exists to decide if it should update or create
    );

    // Update the user data (these changes are not yet saved to the database)
    $user->company_name = $request->company_name;
    $user->email = $request->email;
    $user->mobile = $request->mobile;
    $user->status = $request->status;

    // Save the user to the database
    $user->save();

    return response()->json(['success' => 'User saved successfully.']);
}

    public function edit($id)
    {
        $user = User::find($id);
        $statuses = ['pending', 'accepted', 'rejected']; // Fetch from the database if needed

        // Check if user exists
        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }

        return response()->json([
            'user' => $user,
            'statuses' => $statuses
        ]);
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return response()->json(['success' => 'User deleted successfully.']);
    }
}
