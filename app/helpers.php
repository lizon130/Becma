<?php

use App\Models\Right;
use App\Models\RoleRight;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class Helper
{
    public static function getSettings($key)
    {
        $settings = Setting::where('key', $key)->first();
        if (!is_null($settings)) {
            return $settings->value;
        } else {
            return false;
        }
    }
}
