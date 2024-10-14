<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NoticeController extends Controller
{
    public function index(){
        return view('backend.pages.notice.index');
    }

    public function getList(Request $request)
    {
        $data = Notice::query()->select('id', 'title', 'file', 'status', 'created_at'); // Make sure to select necessary columns

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
                // Display status as "Published" or "Unpublished"
                return $row->status == 'published' ? '<span class="badge bg-success">Published</span>' : '<span class="badge bg-warning">Unpublished</span>';
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
            'title' => 'required|string|max:255',  // Add validation for title
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

            $notice = new Notice();
            $notice->title = $request->title; // Store title
            $notice->description = $request->description; // Store description

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = time() . uniqid() . '.' . $file->getClientOriginalExtension();

                if ($file->getMimeType() === 'application/pdf') {
                    // For PDFs, save in a different folder
                    $file->move(public_path('uploads/notice-pdf'), $filename);
                    $notice->file = 'uploads/notice-pdf/' . $filename;
                } else {
                    // For images
                    $file->move(public_path('uploads/notice-images'), $filename);
                    $notice->file = 'uploads/notice-images/' . $filename;
                }
            }


            $notice->save();

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
        $notice = Notice::find($request->id);

        $data = [
            'notice' => $notice,
        ];
        return view('backend.pages.notice.edit', $data);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',  // Add validation for title
            'description' => 'required|string',     // Add validation for description
            'file' => 'nullable|file|mimes:jpg,png,pdf|max:20480', // Allow images and PDFs, max size 20MB
            'status' => 'required|in:published,unpublished',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'msg' => $validator->errors()->all()[0],
            ], 422);
        }

        try {
            DB::beginTransaction();

            $notice = Notice::find($request->id);

            if (!$notice) {
                $response = [
                    'status' => 0,
                    'msg' => trans('messages.no_event_category_found'),
                ];
                return response()->json($response, 200);
            }

            $notice->title = $request->title; // Store title
            $notice->description = $request->description; // Store description
            $notice->status = $request->status;

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = time() . uniqid() . '.' . $file->getClientOriginalExtension();

                if ($file->getMimeType() === 'application/pdf') {
                    // For PDFs, save in a different folder
                    $file->move(public_path('uploads/notice-pdf'), $filename);
                    $notice->file = 'uploads/notice-pdf/' . $filename;
                } else {
                    // For images
                    $file->move(public_path('uploads/notice-images'), $filename);
                    $notice->file = 'uploads/notice-images/' . $filename;
                }
            }
            $notice->save();

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
            $notice = Notice::find($request->id);

            if (!$notice) {
                $response = [
                    'status' => 0,
                    'msg' => trans('messages.no_event_category_found'),
                ];
                return response()->json($response, 200);
            }

            $notice->delete();
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

    public function notifIndex()
{
    // Fetch the latest published notice
    $latestNotice = Notice::where('status', 'published')
        ->orderBy('created_at', 'desc')
        ->first();

    // Fetch previous notices (excluding the latest one)
    $previousNotices = Notice::where('status', 'published')
        ->where('id', '!=', $latestNotice->id)
        ->orderBy('created_at', 'desc')
        ->get();

    // Mark all unseen notices as seen once the user visits the page
    Notice::where('status', 'published')->where('seen', 0)->update(['seen' => 1]);

    return view('backend.pages.notice.notifIndex', compact('latestNotice', 'previousNotices'));
}


    public function show($id)
    {
        $notice = Notice::findOrFail($id);

        // Mark the notice as seen if it is not already seen
        if (!$notice->seen) {
            $notice->seen = 1;
            $notice->save();
        }

        return view('backend.pages.notice.show', compact('notice'));
    }



    public function viewPdf($id)
{
    $notice = Notice::findOrFail($id);

    if (pathinfo($notice->file, PATHINFO_EXTENSION) === 'pdf') {
        $filePath = public_path($notice->file);

        // Ensure the file exists before attempting to open it
        if (file_exists($filePath)) {
            return response()->file($filePath);
        }
    }
    return redirect()->back()->with('error', 'File not found or unsupported format.');
}



}
