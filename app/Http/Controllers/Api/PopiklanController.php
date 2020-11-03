<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sistems\Setting;

class PopiklanController extends Controller
{
   public function index(Request $request)
   {
        $popup = Setting::where('code','pop_home')->where('is_active','1')->first();
        if($popup){
            return response()->json([
                'success'=>true,
                'iklan'=>asset('images/pophome/').$popup->content
            ],200);
        }else{
            return response()->json([
                'success'=>false,
                'iklan'=>''
            ],400);

        }
   }
}
