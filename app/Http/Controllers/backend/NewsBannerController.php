<?php

namespace App\Http\Controllers\backend;

use App\Models\NewsBanner;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NewsBannerController extends Controller
{
    public function index(){
        return view('backend.pages.news_banner.index');
    }

    public function getList(Request $request)
    {
        $data = NewsBanner::query()->orderBy('created_at', 'desc');

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('image', function ($row) {
                return ($row->image) ? '<img height="60px"  class="border-primary object-fit-contain rounded" src="' . asset($row->image) . '" alt="profile image">' : '<img class="profile-img" src="' . asset('assets/img/no-img.jpg') . '" alt="profile image">';
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
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpg,png|max:20480',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'msg' => $validator->errors()->all()[0],
            ], 422);
        }

        try {
            DB::beginTransaction();

            $newsBanner = new NewsBanner();

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = time() . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/partner-images'), $filename);
                $newsBanner->image = 'uploads/partner-images/' . $filename;
            }
            $newsBanner->save();

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
        $newsBanner = newsBanner::find($request->id);

        $data = [
            'partner' => $newsBanner,
        ];

        return view('backend.pages.news_banner.edit', $data);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'nullable|image|mimes:jpg,png|max:20480',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'msg' => $validator->errors()->all()[0],
            ], 422);
        }

        try {
            DB::beginTransaction();

            $newsBanner = newsBanner::find($request->id);

            if (!$newsBanner) {
                $response = [
                    'status' => 0,
                    'msg' => trans('messages.no_event_category_found'),
                ];
                return response()->json($response, 200);
            }

            if ($request->hasFile('image')) {
                if ($newsBanner->image != Null && file_exists(public_path($newsBanner->image))) {
                    unlink(public_path($newsBanner->image));
                }
                $image = $request->file('image');
                $filename = time() . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/partner-images'), $filename);
                $newsBanner->image = 'uploads/partner-images/' . $filename;
            }
            $newsBanner->save();

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
            $newsBanner = newsBanner::find($request->id);

            if (!$newsBanner) {
                $response = [
                    'status' => 0,
                    'msg' => trans('messages.no_event_category_found'),
                ];
                return response()->json($response, 200);
            }

            $newsBanner->delete();
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