<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WelcomeInfo;

class WelcomeInfoController extends Controller
{
    //
    public function index()
    {
        return response()->json(['data' =>  WelcomeInfo::all()], 200);
    }
}
