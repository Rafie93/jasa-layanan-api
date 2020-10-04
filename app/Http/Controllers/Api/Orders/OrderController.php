<?php

namespace App\Http\Controllers\Api\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders\Order;
use App\Models\Orders\OrderDetail;
use App\Models\Orders\OrderQuery;
use App\Http\Resources\Orders\OrderList as OrderResource;
use App\Http\Resources\Orders\OrderDetailList as OrderDetailResource;
use App\Http\Requests\OrderRequest;

class OrderController extends Controller
{
    public function __construct(OrderQuery $queryObject)
    {
        $this->queryObject = $queryObject;
    }

    public function getOrder(Request $request)
    {
        $order = Order::orderby('id','desc')
                    ->where('creator_id',auth()->user()->id)
                    ->when($request->status, function ($query) use ($request) {
                        if($request->status==1){
                            $query->whereIn('status', [0,1,2,3]);
                        }else if($request->status==99){
                            $query->where('status',99);
                        }else if($request->status==6){
                            $query->where('status',6);
                        }
                        else if($request->status==7){
                            $query->where('status',7);
                        }
                    })
                    ->get();

        return response()->json([
            'success'=>true,
            'orders' =>  new OrderResource($order)
        ], 200);
    }

    public function getOrderDetail(Request $request,$id)
    {
        $order = OrderDetail::orderBy('id','asc')->where('order_id',$id)->get();
        return response()->json([
            'success'=>true,
            'order' =>Order::find($id),
            'detail' => new OrderDetailResource($order)
        ], 200);
    }

    public function store(OrderRequest $request)
    {
       $save = $this->queryObject->store($request);
       if($save!=""){
          $o = Order::where('id',$save)->first();
          return response()->json([
            'success'=>true,
            'message'=>"Pesanan Berhasil Dibuat, Silahkan Hubungi CS untuk kesepakat harga",
            'code' => $o->code,
            'order_id' => $save,
            'detail' => $o
        ], 200);
       }else{
        return response()->json([
            'success'=>false,
            'message'=>"Gagal membuat, coba beberapa saat lagi..",
            'code' => ''
        ], 400);
       }
    }

}
