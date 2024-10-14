<?php

namespace App\Http\Controllers\backend;

use Log;
use App\Models\Complaint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class AdminComplaintController extends Controller
{
    public function index()
    {
        $complaints = Complaint::all();
        return view('backend.pages.complaint.admin.index', compact('complaints'));
    }

    public function getUsers(Request $request)
    {
        if ($request->ajax()) {
            $data = Complaint::with('user') // Load related user data
                    ->select('id', 'seller_id', 'subject', 'file', 'status')
                    ->orderBy('updated_at', 'DESC')
                    ->get();
                    
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('seller', function ($row) {
                    return $row->user ? $row->user->company_name : 'N/A'; 
                })
                ->editColumn('file', function ($row) {
                    // Check if the file exists and determine its type (image or PDF)
                    if ($row->file) {
                        $filePath = asset($row->file);
                        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                    
                        if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif'])) {
                            // Display image preview with modal trigger
                            return '<a href="#" data-bs-toggle="modal" data-bs-target="#imageModal" data-img-src="' . $filePath . '">
                                        <img height="60px" width="80px" class="border-primary rounded" style="object-fit: cover;" src="' . $filePath . '" alt="uploaded file">
                                    </a>';
                        } elseif (strtolower($fileExtension) === 'pdf') {
                            // Display PDF icon with link to view the PDF
                            return '<a style="color: black" href="' . $filePath . '" target="_blank" class="btn btn-secondary btn-sm">View PDF</a>';
                        }
                    }
                    
                    // If no file is uploaded, show default image
                    return '<img height="60px" width="80px" class="border-primary rounded" style="object-fit: cover;" src="' . asset('assets/img/no-img.jpg') . '" alt="no file">';
                    
                })
                ->addColumn('status', function ($row) {
                    // Create a select dropdown for status options
                    $statusOptions = [
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'finished' => 'Finished',
                    ];
                
                    // Create the select element with current status selected
                    $selectHtml = '<select class="form-select form-select-sm status-select" data-id="' . $row->id . '">';
                
                    foreach ($statusOptions as $value => $label) {
                        $selected = ($row->status === $value) ? 'selected' : '';
                        $selectHtml .= '<option value="' . $value . '" ' . $selected . '>' . ucfirst($label) . '</option>';
                    }
                
                    $selectHtml .= '</select>';
                
                    return $selectHtml;
                })
                
                
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="edit btn btn-primary btn-sm viewUser">View</a>';
                    $btn .= ' <a href="javascript:void(0)" data-id="'.$row->id.'" class="delete btn btn-danger btn-sm deleteUser">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['file' ,'status', 'action'])
                ->make(true);
        }
    }

    public function updateStatus(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'id' => 'required|exists:complaints,id', // Ensure the complaint exists
            'status' => 'required|in:pending,processing,finished', // Validate status
        ]);
    
        // Find the complaint by ID
        $complaint = Complaint::find($validatedData['id']);
    
        if (!$complaint) {
            return response()->json([
                'success' => false,
                'message' => 'Complaint not found'
            ], 404);
        }
    
        // Update the status
        $complaint->status = $validatedData['status'];
        $complaint->save();
    
        return response()->json([
            'success' => true,
            'message' => 'Complaint status updated successfully!'
        ]);
    }

    public function edit($id)
    {
        $user = Complaint::find($id);
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
        Complaint::find($id)->delete();
        return response()->json(['success' => 'User deleted successfully.']);
    }
}

    

