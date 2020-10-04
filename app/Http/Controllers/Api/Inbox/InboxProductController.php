<?php

namespace App\Http\Controllers\Api\Inbox;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Products\CommentProductList as CommentProductResource;
use App\Models\Products\ProductComment;
use App\Models\Products\Product;

class InboxProductController extends Controller
{

    public function list(Request $request)
    {
        $by = auth()->user()->id;
        $list_inbox = ProductComment::select('product_id')
                            ->groupBy('product_id')
                            ->where(function($query) use ($by){
                                $query->where('to',$by)->orWhere('creator_id', '=',$by);
                            })
                            ->get();

        $out=[];
        foreach ($list_inbox as $row){
            $product_comment = ProductComment::orderBy('id','desc')->where('product_id',$row->product_id)->first();
            $out[] = array(
                'product_id' => $row->product_id,
                'product_name' => Product::find($row->product_id)->name,
                'last_pesan' => $product_comment->commentar,
                'is_read' => $product_comment->is_read,
                'type' => $product_comment->type
            );
        }

        return response()->json([
                                'success'=>true,
                                'data'=> $out
                            ], 200);
    }

    public function store(Request $request)
    {
        ProductComment::create([
            'product_id'=>$request->id,
            'commentar' => $request->pesan,
            'creator_id' => auth()->user()->id,
            'to' => 'admin',
            'type' => 'user',
            'is_read' => 0
        ]);

        return response()->json([
            'success' =>true
        ], 200);
    }
}
