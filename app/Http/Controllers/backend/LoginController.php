<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class LoginController extends Controller
{

    public function adminProfile()
    {
        $user = Auth::user();
        return view('backend.pages.auth.profile', compact('user'));
    }

    public function adminProfileUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profile_image' => 'nullable|image:png,jpg,jpeg,gif,webp,',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::find(Auth::user()->id);
        $user->company_name = $request->company_name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->nid = $request->nid;
        $user->dob = $request->dob;
        $user->address = $request->address;

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $filename = time() . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/user-images'), $filename);
            $user->profile_image = 'uploads/user-images/' . $filename;
        }

        if ($user->save()) {
            return redirect()->back()->with('success', 'Your profile has been updated.');
        } else {
            return redirect()->back()->withErrors(['error' => 'Something went wrong.']);
        }
    }


    public function adminProfileSetting()
    {
        $user = Auth::user();
        return view('backend.pages.auth.setting', compact('user'));
    }

    public function adminChangePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::find(Auth::user()->id);
        if (Hash::check($request->current_password, $user->password)) {
            $user->password = Hash::make($request->password);
            if ($user->save()) {
                return redirect()->back()->with('success', 'Password has been changed.');
            } else {
                return redirect()->back()->withErrors(['error' => 'Something went wrong.']);
            }
        } else {
            return redirect()->back()->withErrors(['error' => 'Current password not match.']);
        }
    }
}
