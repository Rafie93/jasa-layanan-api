<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Point;
class PointController extends Controller
{
    public function poinList(Request $request)
    {
        $q = $request->q;
        $point = Point::orderBy('id','desc')
                        ->where(function ($query) use ($q){
                            $query->where('point','LIKE','%'.$q.'%')->orWhere('kode','LIKE','%'.$q.'%');
                        })
                        ->get();
            
        return response()->json([
            'success'=>true,
            'data'=>$point,
        ], 200);
    }
}
