<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //

    public function getNotificationList(Request $request)
    {
        $per_page = $request->query('per_page');
        $status = $request->status;
        error_log($status);
        return response()->json(Notification::orderBy('type', 'desc')->paginate($per_page), 200);
    }
}
