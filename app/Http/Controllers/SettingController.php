<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('settings.index');
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        if($request->notification_email) {
            $user->settings([
                'notification_email' => 1
            ]);
        }

        return redirect()->route('settings.index')
            ->with('success', 'Настройки сохранены');
    }
}
