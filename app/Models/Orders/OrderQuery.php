<?php
namespace App\Models\Orders;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Customer\Customer;
use App\Models\Orders\Order;
use App\Models\Orders\OrderDetail;

/**
* Order Query Object
*/
class OrderQuery
{
    public function getOrderRequest()
    {
        return Order::orderBy('id','desc')
                    ->whereIn('status',[1,3])->get();
    }
    public function getOrderComplete()
    {
        return Order::orderBy('id','desc')
                    ->where('status',7)->get();
    }
    public function getOrderCancel()
    {
        return Order::orderBy('id','desc')
                    ->where('status',5)->get();
    }
    public function getOrderProses()
    {
        return Order::orderBy('id','desc')
                    ->whereIn('status',[4,44])->get();
    }
    public function getPorductOrder($orderId)
    {
        return OrderDetail::orderBy('id','desc')
                    ->where('order_id',$orderId)->get();
    }
    public function update($request, $order)
    {
        $status = $request->status;
        if($status==3){
            $request->merge(['date_deal'=>$request->date]);
        }else if($status==4){
            $request->merge(['date_proses'=>$request->date]);
        }
        else if($status==44){
            $request->merge(['date_send'=>$request->date]);
        }
        else if($status==7){
            $request->merge(['date_complete'=>$request->date]);
        }

        $order->update($request->all());
    }

    //Store Order
    public function store($request)
    {
        $customer_id = $request->customer ? $request->customer : $this->getCustomer(auth()->user()->id) ;
        $code = $this->generateCode($customer_id);
        $payment_method = $request->payment_method;
        $payment=1;
        if($payment_method=="COD"){
            $payment=2;
        }else if($payment_method=="Kredit"){
            $payment=3;
        }
        $request->merge([
            'code' => $code,
            'creator_id' => auth()->user()->id,
            'customer_id' => $customer_id,
            'status' => 1,
            'payment_method' => $payment,
            'date_order' => date('Y-m-d H:i:s'),
            'date_in_use' => $request->date_in_use,
            'sub_total' => $request->sub_total,
            'price_total' => $request->price_total,
            'price_deal' => $request->price_deal ? $request->deal :0,
            'address_shipping' => $request->address_shipping
        ]);
        $yeePoint = false;
        if($request->poin_dikurangkan!=0){
            $yeePoint = true;
            $request->merge(['potongan' => $request->poin_dikurangkan]);
        }

        try
        {
             DB::beginTransaction();
                $order = Order::create($request->all());
                $orderId = $order->id;
                if($yeePoint){
                    $uId = auth()->user()->id;
                    $user = User::find($uId)->first();
                    $user->update([
                        'point' => $user->point - $request->poin_dikurangkan
                    ]);
                }

                $productcss = $request->products;
                if($productcss){
                    $produkArray = json_decode($productcss, true);
                    $macamProduk = count($produkArray);
                    for ($i=0; $i < $macamProduk; $i++) {
                        $product_id = $produkArray[$i]["product_id"];
                        $product_price_id = $produkArray[$i]["product_price_id"];
                        $keterangan = $produkArray[$i]["keterangan"];
                        $price = $produkArray[$i]['price'];
                        $quantity = $produkArray[$i]['qty'];

                        $detail = new \App\Models\Orders\OrderDetail;
                        $detail->order_id = $order->id;
                        $detail->product_id = $product_id;
                        $detail->product_price_id = $product_price_id;
                        $detail->quantity = $quantity;
                        $detail->quantity_received = $quantity;
                        $detail->price = $price;
                        $detail->keterangan = $keterangan;
                        $detail->save();
                    }
                }

             DB::commit();
            return $orderId;
        }catch (\PDOException $e) {
            DB::rollBack();
            return "";
        }
        return "";

    }
    public function generateCode($customer_id)
    {
        return "OD".date('dmyhis').$customer_id;
    }

    public function getCustomer($user_id)
    {
        return Customer::where('user_id',$user_id)->first()->id;
    }

}
