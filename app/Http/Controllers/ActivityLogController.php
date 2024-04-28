<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog; // Import the ActivityLog model

class ActivityLogController extends Controller
{
    //
    public function index()
    {
        $logs = ActivityLog::orderBy('created_at', 'desc')->paginate(10);
        
        // Get authenticated user's notifications
        $user = Auth::user();
        $notifications = $user->unreadNotifications;

    return view('pages.activity_logs', compact('logs','notifications'));
    }
}
