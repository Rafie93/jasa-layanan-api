<?php

namespace App\Http\Controllers\Api\Beranda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Landing\Banner;
use App\Http\Resources\Banners\BannerList as BannerResource;
use App\Http\Resources\User as UserResource;
use App\User;

class BerandaController extends Controller
{
    public function getBanner(Request $request)
    {
        return response()->json([
            'success'=>true,
            'slider'=>new BannerResource(Banner::all())
        ], 200);
    }


}
