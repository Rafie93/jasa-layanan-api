<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Slide;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\SlideList as SlideResource;

class DashboardController extends Controller
{
    //
    public function dashboard(Request $request)
    {
        $user = Auth::user();
        $slide = Slide::where('jenis','Slide Primary')
                        ->whereNull('expired')
                        ->orWhere(function($query){
                            $query->where('expired', '<=', date('Y-m-d'));
                        })
                        ->get();

        $slide2 = Slide::where('jenis','Slide Seccondary')
                    ->whereNull('expired')
                    ->orWhere(function($query){
                        $query->where('expired', '<=', date('Y-m-d'));
                    })
                    ->get();
            
        return response()->json([
            'success'=>true,
            'slide'=>new SlideResource($slide),
            'slide_seccondary'=>new SlideResource($slide2),
            'user'=>new UserResource($user)
        ], 200);

    }
}
