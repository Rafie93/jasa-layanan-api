<?php

namespace App\Http\Controllers\Api\Inbox;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Orders\Order;
use App\Models\Orders\OrderComment;

class InboxOrderController extends Controller
{
    public function list(Request $request)
    {
        $by = auth()->user()->id;
        $list_inbox = OrderComment::select('order_id')
                            ->groupBy('order_id')
                            ->where(function($query) use ($by){
                                $query->where('to',$by)->orWhere('creator_id', '=',$by);
                            })
                            ->get();

        $out=[];
        foreach ($list_inbox as $row){
            $order_comment = OrderComment::orderBy('id','desc')->where('order_id',$row->order_id)->first();
            $out[] = array(
                'order_id' => $row->order_id,
                'order_code' => Order::find($row->order_id)->code,
                'last_pesan' => $order_comment->pesan,
                'is_read' => $order_comment->is_read,
                'type' => $order_comment->pesan_by
            );
        }

        return response()->json([
                                'success'=>true,
                                'data'=> $out
                            ], 200);
    }

    public function detail($id)
    {
        $order_comment = OrderComment::orderBy('id','asc')->where('order_id',$id)->get();
        return response()->json([
            'pesan' =>$order_comment
        ], 200);
    }

    public function store(Request $request)
    {
        OrderComment::create([
            'order_id'=>$request->id,
            'pesan' => $request->pesan,
            'creator_id' => auth()->user()->id,
            'to' => 'admin',
            'pesan_by' => 'user',
            'is_read' => 0
        ]);

        return response()->json([
            'success' =>true
        ], 200);
    }
}
