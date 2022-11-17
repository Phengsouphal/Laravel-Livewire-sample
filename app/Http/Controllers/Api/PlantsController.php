<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plants;
use App\Models\WelcomeInfo;

class PlantsController extends Controller
{
    //
    public function index()
    {
        return response()->json(['data' =>  Plants::paginate(10)], 200);
    }

    //
    public function getSpecialOffers()
    {
        return response()->json(['data' =>  Plants::offset(0)->limit(10)->get()], 200);
    }
}
