<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    //
    public function getTransactionList(Request $request)
    {
        $per_page = $request->query('per_page');
        $status = $request->status;
        error_log($status);
        return response()->json(Transaction::where('status', $status)->paginate($per_page), 200);
    }
}
