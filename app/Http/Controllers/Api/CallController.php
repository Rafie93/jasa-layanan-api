<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting;
use App\Http\Resources\CallList as CallResource;

class CallController extends Controller
{
    //
    public function call(Request $request)
    {
        $calls = Setting::all();
        
        return response()->json([
            'success'=>true,
            'data'=>new CallResource($calls),
        ], 200);
    }
}
