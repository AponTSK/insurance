<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class UserSettingController extends Controller
{
    public function setting()
    {
        $pageTitle = "User Setting";
        return view('Template::user.setting.index', compact('pageTitle'));
    }
    public function notificationSetting()
    {
        $pageTitle = "User Setting";
        return view('Template::user.setting.notification', compact('pageTitle'));
    }
}
