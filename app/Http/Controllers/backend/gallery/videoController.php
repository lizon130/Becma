<?php

namespace App\Http\Controllers\backend\gallery;

use App\Http\Controllers\Controller;
use App\Models\Gallery_video;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class videoController extends Controller
{
    public function index(){
        return view('backend.pages.gallery_video.index');
    }

    public function getList(Request $request)
    {
        $data = Gallery_video::query()->orderBy('created_at', 'desc');

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('video', function ($row) {
                if ($row->video) {
                    return '<video width="100" controls>
                                <source src="' . asset($row->video) . '" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>';
                } else {
                    return '<span>No video available</span>';
                }
            })
            ->editColumn('title', function ($row) {
                return $row->title;
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at;
            })
            ->addColumn('action', function ($row) {
                $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="edit btn btn-primary btn-sm edit_btn">Edit</a>';
                $btn .= ' <a href="javascript:void(0)" data-id="'.$row->id.'" class="delete btn btn-danger btn-sm delete_btn">Delete</a>';
                return $btn;
            })
            ->rawColumns(['video', 'action']) // Ensure 'action' is included here
            ->make(true);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'video' => 'required|mimes:mp4,mov,avi,wmv|max:51200', 
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'msg' => $validator->errors()->all()[0],
            ], 422);
        }

        try {
            DB::beginTransaction();

            $gallery_video = new Gallery_video();

            if ($request->hasFile('video')) {
                $video = $request->file('video');
                $videoFilename = time() . uniqid() . '.' . $video->getClientOriginalExtension();
                $video->move(public_path('uploads/gallery-videos'), $videoFilename);
                $gallery_video->video = 'uploads/gallery-videos/' . $videoFilename;
            }
            $gallery_video->save();

            DB::commit();

            return response()->json([
                'status' => 1,
                'msg' => trans('messages.category_created_successfully'),
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());  // Log the error message

            return response()->json([
                'status' => 0,
                'msg' => trans('messages.something_went_wrong'),
                'error' => $th->getMessage(),
            ], 200);
        }
    }

    public function edit(Request $request)
    {
        $gallery_video = Gallery_video::find($request->id);

        $data = [
            'gallery_video' => $gallery_video,
        ];

        return view('backend.pages.gallery_video.edit', $data);
    }

    public function update(Request $request)
{
    // Update validation, 'video' is not always required on update
    $validator = Validator::make($request->all(), [
        'video' => 'nullable|mimes:mp4,mov,avi,wmv|max:51200',  
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 0,
            'msg' => $validator->errors()->all()[0],
        ], 422);
    }

    try {
        DB::beginTransaction();

        // Find the video by ID
        $gallery_video = Gallery_video::find($request->id);

        if (!$gallery_video) {
            return response()->json([
                'status' => 0,
                'msg' => trans('messages.no_event_category_found'),
            ], 200);
        }

        // Check if new video file is uploaded
        if ($request->hasFile('video')) {
            // Delete the old video if it exists
            if (!is_null($gallery_video->video) && file_exists(public_path($gallery_video->video))) {
                unlink(public_path($gallery_video->video));  // Ensure the file exists before attempting to delete
            }

            // Upload the new video
            $video = $request->file('video');
            $videoFilename = time() . uniqid() . '.' . $video->getClientOriginalExtension();
            $video->move(public_path('uploads/gallery-videos'), $videoFilename);

            // Update the video path in the database
            $gallery_video->video = 'uploads/gallery-videos/' . $videoFilename;
        }

        // Save the changes
        $gallery_video->save();

        DB::commit();

        // Return success response
        return response()->json([
            'status' => 1,
            'msg' => trans('messages.category_updated_successfully'),
        ], 200);
    } catch (\Throwable $th) {
        DB::rollBack();
        Log::error($th->getMessage());  // Log the error for debugging

        return response()->json([
            'status' => 0,
            'msg' => trans('messages.something_went_wrong'),
            'error' => $th->getMessage(),
        ], 200);
    }
}


    public function delete(Request $request)
    {
        try {
            DB::beginTransaction();
            $partner = Gallery_video::find($request->id);

            if (!$partner) {
                $response = [
                    'status' => 0,
                    'msg' => trans('messages.no_event_category_found'),
                ];
                return response()->json($response, 200);
            }

            $partner->delete();
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
