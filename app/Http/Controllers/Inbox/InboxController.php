<?php

namespace App\Http\Controllers\Inbox;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products\ProductComment;
use App\Models\Products\Product;
use App\User;
class InboxController extends Controller
{
    //
    public function index(Request $request)
    {
        $by = 'admin';
        $list_inbox = ProductComment::select('product_id')
                            ->groupBy('product_id')
                            ->where(function($query) use ($by){
                                $query->where('to',$by)->orWhere('creator_id', '=',$by);
                            })
                            ->get();

        $inboxs=[];
        foreach ($list_inbox as $row){
            $product_comment = ProductComment::orderBy('id','desc')->where('product_id',$row->product_id)->first();
            $inboxs[] = array(
                'creator_name' => User::find($product_comment->creator_id)->first()->name,
                'product_id' => $row->product_id,
                'product_name' => Product::find($row->product_id)->name,
                'last_pesan' => $product_comment->commentar,
                'is_read' => $product_comment->is_read,
                'type' => $product_comment->type
            );
        }


        return view('inbox.index',compact('inboxs'));
    }
}
