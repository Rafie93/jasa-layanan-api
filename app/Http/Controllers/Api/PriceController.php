<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PriceList;
use App\Http\Resources\PriceList as PriceResource;

class PriceController extends Controller
{
    public function priceList(Request $request)
    {
        $q = $request->q;
        $price = PriceList::orderBy('jenis','asc')
                        ->orderBy('id','desc')
                        ->where(function ($query) use ($q){
                            $query->where('nama','LIKE','%'.$q.'%')->orWhere('deskripsi','LIKE','%'.$q.'%');
                        })
                        ->get();
            
        return response()->json([
         'success' => true,
         'data' =>  new PriceResource($price)
        ],200);
    }
}
