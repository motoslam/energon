<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class AlertController extends Controller
{
    public function index()
    {
        return view('notifications.index');
    }

}
