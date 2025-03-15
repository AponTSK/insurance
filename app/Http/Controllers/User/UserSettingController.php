<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class UserSettingController extends Controller
{
    public function setting()
    {
        $pageTitle = "User Setting";
        $user      = auth()->user();
        return view('Template::user.setting.index', compact('pageTitle', 'user'));
    }
    public function notificationSetting()
    {
        $pageTitle = "User Setting";
        return view('Template::user.setting.notification', compact('pageTitle'));
    }
}
