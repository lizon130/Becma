<?php

namespace App\Http\Controllers\backend;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function general(){
        return view('backend.pages.setting.general');
    }

    public function staticContent(){
        return view('backend.pages.setting.static-content');
    }

    public function legalContent (){
        return view('backend.pages.setting.legal-content');
    }

    public function update(Request $request){
        $data = [];

        foreach($request->file() as $key => $val){
            if ($request->hasFile($key)) {
                $image = $request->file($key);
                $filename = time().uniqid().$image->getClientOriginalName();
                $image->move(public_path('uploads/settings'), $filename);
                $data[$key] = $filename;
            }
        }

        foreach ($request->input() as $key => $val) {
            if (!is_array($val)) {
                $request->validate([
                    $val => 'nullable | string'
                ]);
                $data[$key] = $val;
            } else {
                $data[$key] = implode(',', $val);
            }
        }
        unset($data['_token']);

        foreach ($data as $key => $val) {
            $settings = Setting::updateOrCreate(
                ['key' =>  $key],
                ['value' => $val]
            );
        }
        session()->flash('success', 'Settings Successfully Updated!');
        return back();
    }
}
