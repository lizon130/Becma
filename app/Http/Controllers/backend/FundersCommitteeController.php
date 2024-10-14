<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Executive_commitee;

class FundersCommitteeController extends Controller
{
    public function index(){
        return view('backend.pages.funders_commitee.index');
    }

    public function getList(Request $request)
    {
        $data = Executive_commitee::where('committee_category', 'funders_committee')
        ->orderBy('created_at', 'desc');

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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'designation' => 'required',
            'image' => 'required|image|mimes:jpg,png|max:20480',
            'fb_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
            'committee_category' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'msg' => $validator->errors()->all()[0],
            ], 422);
        }

        try {
            DB::beginTransaction();

            $executive = new Executive_commitee();
            $executive->name = $request->name;
            $executive->designation = $request->designation;
            $executive->fb_link = $request->fb_link;
            $executive->linkedin_link = $request->linkedin_link;
            $executive->committee_category = $request->committee_category;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = time() . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/executive-images'), $filename);
                $executive->image = 'uploads/executive-images/' . $filename;
            }
            $executive->save();

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
        $executive = Executive_commitee::find($request->id);

        $data = [
            'executive' => $executive,
        ];

        return view('backend.pages.funders_commitee.edit', $data);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'designation' => 'required',
            'image' => 'nullable|image|mimes:jpg,png|max:20480',
            'fb_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
            'committee_category' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'msg' => $validator->errors()->all()[0],
            ], 422);
        }

        try {
            DB::beginTransaction();

            $executive = Executive_commitee::find($request->id);

            if (!$executive) {
                $response = [
                    'status' => 0,
                    'msg' => trans('messages.no_event_category_found'),
                ];
                return response()->json($response, 200);
            }

            $executive->name = $request->name;
            $executive->designation = $request->designation;
            $executive->fb_link = $request->fb_link;
            $executive->linkedin_link = $request->linkedin_link;
            $executive->committee_category = $request->committee_category;

            if ($request->hasFile('image')) {
                if ($executive->image != Null && file_exists(public_path($executive->image))) {
                    unlink(public_path($executive->image));
                }
                $image = $request->file('image');
                $filename = time() . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/executive-images'), $filename);
                $executive->image = 'uploads/executive-images/' . $filename;
            }
            $executive->save();

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
            $executive = Executive_commitee::find($request->id);

            if (!$executive) {
                $response = [
                    'status' => 0,
                    'msg' => trans('messages.no_event_category_found'),
                ];
                return response()->json($response, 200);
            }

            $executive->delete();
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
