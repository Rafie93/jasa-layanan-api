<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders\Order;
use App\Models\Orders\OrderQuery;

class OrderController extends Controller
{
    public function __construct(OrderQuery $queryObject)
    {
        $this->queryObject = $queryObject;
    }

    public function request(Request $request)
    {
        return view('order.index');
    }
    public function detail(Request $request,$code)
    {
        $order = Order::where('code',$code)->first();
        return view('order.detail',compact('order'));
    }
    public function update(Request $request,$id)
    {
        $order = Order::where('id',$id)->first();
        $this->queryObject->update($request,$order);
        logUpdate(auth()->user()->id,'Konfirmasi Order ID : '.$order->code,'Order');
        return redirect()->route('order.order')->with('sukses','Data Berhasil diperbaharui');
    }
}
