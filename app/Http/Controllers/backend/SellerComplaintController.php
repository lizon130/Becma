<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SellerComplaintController extends Controller
{

    public function index(){
        return view('backend.pages.complaint.seller.index');
    }

    // public function index()
    // {
    //     $complaints = Complaint::where('seller_id', Auth::id())->get();
    //     return view('backend.pages.complaint.sellerComplaint', compact('complaints'));
    // }

    public function getList(Request $request)
    {
        // $data = Complaint::query()->select('id', 'seller_id', 'subject', 'file', 'status', 'created_at'); 

        $data = Complaint::where('seller_id', Auth::id())->get();


        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('file', function ($row) {
                // Check if the file exists and determine its type (image or PDF)
                if ($row->file) {
                    $filePath = asset($row->file);
                    $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);

                    if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif'])) {
                        // Display image preview
                        return '<img height="60px" width="80px" class="border-primary rounded" style="object-fit: cover;" src="' . $filePath . '" alt="uploaded file">';
                    } elseif (strtolower($fileExtension) === 'pdf') {
                        // Display PDF icon with link to view the PDF
                        return '<a style="color: black" href="' . $filePath . '" target="_blank" class="btn btn-secondary btn-sm">View PDF</a>';
                    }
                }
                // If no file is uploaded, show default image
                return '<img height="60px" width="80px" class="border-primary rounded" style="object-fit: cover;" src="' . asset('assets/img/no-img.jpg') . '" alt="no file">';
            })
            ->editColumn('title', function ($row) {
                return $row->title;
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at;
            })
            ->editColumn('status', function ($row) {
                // Display status with badges for Pending, Processing, and Finished
                switch ($row->status) {
                    case 'pending':
                        return '<span class="badge bg-warning">Pending</span>';
                    case 'processing':
                        return '<span class="badge bg-info">Processing</span>';
                    case 'finished':
                        return '<span class="badge bg-success">Finished</span>';
                    default:
                        return '<span class="badge bg-secondary">Unknown</span>';
                }
            })
            
            ->addColumn('action', function ($row) {
                $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="edit btn btn-primary btn-sm edit_btn">Edit</a>';
                $btn .= ' <a href="javascript:void(0)" data-id="'.$row->id.'" class="delete btn btn-danger btn-sm delete_btn">Delete</a>';
                return $btn;
            })
            ->rawColumns(['file', 'status' ,'action']) // Ensure 'action' is included here
            ->make(true);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'subject' => 'required|string|max:255',  // Add validation for title
            'description' => 'required|string',     // Add validation for description
            'file' => 'nullable|file|mimes:jpg,png,pdf|max:20480', // Allow images and PDFs, max size 20MB
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'msg' => $validator->errors()->all()[0],
            ], 422);
        }

        try {
            DB::beginTransaction();

            $complaint = new Complaint();
            
            $complaint->subject = $request->subject; 
            $complaint->description = $request->description; 
            $complaint->seller_id = Auth::id();

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = time() . uniqid() . '.' . $file->getClientOriginalExtension();

                if ($file->getMimeType() === 'application/pdf') {
                    // For PDFs, save in a different folder
                    $file->move(public_path('uploads/complain-pdf'), $filename);
                    $complaint->file = 'uploads/complain-pdf/' . $filename;
                } else {
                    // For images
                    $file->move(public_path('uploads/complain-images'), $filename);
                    $complaint->file = 'uploads/complain-images/' . $filename;
                }
            }
            
            $complaint->save();

            DB::commit();

            return response()->json([
                'status' => 1,
                'msg' => trans('messages.file_uploaded_successfully'),
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());

            return response()->json([
                'status' => 0,
                'msg' => trans('messages.something_went_wrong'),
                'error' => $th->getMessage(),
            ], 200);
        }
    }

    public function edit(Request $request)
    {
        $complaint = Complaint::find($request->id);

        $data = [
            'complaint' => $complaint,
        ];
        return view('backend.pages.complaint.seller.edit', $data);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject' => 'required|string|max:255',  // Add validation for title
            'description' => 'required|string',     // Add validation for description
            'file' => 'nullable|file|mimes:jpg,png,pdf|max:20480', // Allow images and PDFs, max size 20MB
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'msg' => $validator->errors()->all()[0],
            ], 422);
        }

        try {
            DB::beginTransaction();

            $complaint = Complaint::find($request->id);

            if (!$complaint) {
                $response = [
                    'status' => 0,
                    'msg' => trans('messages.no_event_category_found'),
                ];
                return response()->json($response, 200);
            }

            $complaint->subject = $request->subject; 
            $complaint->description = $request->description; 
            $complaint->seller_id = Auth::id();


            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = time() . uniqid() . '.' . $file->getClientOriginalExtension();

                if ($file->getMimeType() === 'application/pdf') {
                    // For PDFs, save in a different folder
                    $file->move(public_path('uploads/complain-pdf'), $filename);
                    $complaint->file = 'uploads/complain-pdf/' . $filename;
                } else {
                    // For images
                    $file->move(public_path('uploads/complain-images'), $filename);
                    $complaint->file = 'uploads/complain-images/' . $filename;
                }
            }
            $complaint->save();

            DB::commit();

            $response = [
                'status' => 1,
                'msg' => trans('messages.category_updated_successfully'),
            ];
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            $response = [
                'status' => 0,
                'msg' => trans('messages.something_went_wrong'),
                'error' => $th->getMessage(),
            ];
            return response()->json($response, 200);
        }
    }

    public function delete(Request $request)
    {
        try {
            DB::beginTransaction();
            $complaint = Complaint::find($request->id);

            if (!$complaint) {
                $response = [
                    'status' => 0,
                    'msg' => trans('messages.no_event_category_found'),
                ];
                return response()->json($response, 200);
            }

            $complaint->delete();
            DB::commit();

            $response = [
                'status' => 1,
                'msg' => trans('messages.category_deleted_successfully'),
            ];
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            $response = [
                'status' => 0,
                'msg' => trans('messages.something_went_wrong'),
                'error' => $th->getMessage(),
            ];
            return response()->json($response, 200);
        }
    }
  
}
