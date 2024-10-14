<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class NewsController extends Controller
{
    public function index(){
        return view('backend.pages.news.index');
    }

    public function getList(Request $request)
    {
        $data = News::query()->orderBy('created_at', 'desc');

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('image', function ($row) {
                return ($row->image) ? 
                    '<img height="60px" width="80px" class="border-primary rounded" style="object-fit: cover;" src="' . asset($row->image) . '" alt="profile image">' : 
                    '<img height="60px" width="80px" class="border-primary rounded" style="object-fit: cover;" src="' . asset('assets/img/no-img.jpg') . '" alt="profile image">';
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
            ->rawColumns(['image', 'action']) // Ensure 'action' is included here
            ->make(true);
    }

    public function store(Request $request)
{
    // Validation
    $validator = Validator::make($request->all(), [
        'title' => 'required',
        'description' => 'required',
        'image' => 'required|image|mimes:jpg,png|max:20480',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 0,
            'msg' => $validator->errors()->all()[0],  // Send back the first error message
        ], 422);  // Validation failed, return 422 status
    }

    try {
        DB::beginTransaction();

        // Create new News instance
        $news = new News();
        $news->title = $request->title;
        $news->description = $request->description;

        // Handling the image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_filename = time() . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/news-images'), $image_filename);
            $news->image = 'uploads/news-images/' . $image_filename;
        }

        // Save the news
        $news->save();

        DB::commit();

        return response()->json([
            'status' => 1,
            'msg' => trans('messages.category_created_successfully'),
        ], 200);

    } catch (\Throwable $th) {
        DB::rollBack();
        Log::error($th->getMessage());

        // Return a proper error status code
        return response()->json([
            'status' => 0,
            'msg' => trans('messages.something_went_wrong'),
            // 'error' => $th->getMessage(),  // Only useful for debugging; you can remove in production
        ], 500);  // Error status changed to 500
    }
}



    public function edit(Request $request)
    {
        $news = News::find($request->id);

        $data = [
            'news' => $news,
        ];

        return view('backend.pages.news.edit', $data);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpg,png|max:20480',  // No longer required
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'msg' => $validator->errors()->all()[0],
            ], 422);
        }

        try {
            DB::beginTransaction();

            $news = News::find($request->id);

            if (!$news) {
                return response()->json([
                    'status' => 0,
                    'msg' => trans('messages.no_event_category_found'),
                ], 200);
            }

            $news->title = $request->title;
            $news->description = $request->description;

            // Handle image upload
            if ($request->hasFile('image')) {
                if ($news->image != null && file_exists(public_path($news->image))) {
                    unlink(public_path($news->image));
                }
                $image = $request->file('image');
                $filename = time() . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/news-images'), $filename);
                $news->image = 'uploads/news-images/' . $filename;
            }

            $news->save();
            DB::commit();

            return response()->json([
                'status' => 1,
                'msg' => trans('messages.category_updated_successfully'),
            ], 200);

        } catch (\Throwable $th) {
            DB::rollBack();
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
            $news = News::find($request->id);

            if (!$news) {
                $response = [
                    'status' => 0,
                    'msg' => trans('messages.no_event_category_found'),
                ];
                return response()->json($response, 200);
            }

            $news->delete();
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
