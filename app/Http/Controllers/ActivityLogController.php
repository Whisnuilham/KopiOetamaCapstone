<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog; // Import the ActivityLog model

class ActivityLogController extends Controller
{
    //
    public function index()
    {
        $logs = ActivityLog::orderBy('created_at', 'desc')->paginate(10);
    return view('pages.activity_logs', compact('logs'));
    }
}
