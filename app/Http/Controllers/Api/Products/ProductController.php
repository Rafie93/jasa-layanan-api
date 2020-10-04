<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Products\ProductList as ProductResource;
use App\Http\Resources\Products\CommentProductList as CommentProductResource;
use App\Http\Resources\Products\ProductItem as ProductItemResource;

use App\Models\Products\ProductQuery;

class ProductController extends Controller
{
    public function __construct(ProductQuery $productObject)
    {
        $this->productObject = $productObject;
    }

    public function getProduct(Request $request)
    {
        $limit = $request->limit ? $request->limit : 20;
        $product = $this->productObject->getProduct($request,'id','desc',$limit);
        return response()->json([
            'success'=>true,
            'products'=>new ProductResource($product)
        ], 200);
    }

    public function getProductDetail($id)
    {
        $product = $this->productObject->getProductDetail($id);
        $comment = $this->productObject->getProductComment($id);

        return response()->json([
            'products'=>new ProductItemResource($product),
            'products_comment' =>new CommentProductResource($comment)
        ], 200);
    }

    public function product_comment(Request $request,$id)
    {
        $comment = $this->productObject->getProductComment($id);
        return response()->json([
            'success'=>true,
            'product_id' => $id,
            'product_comment'=>new CommentProductResource($comment)
        ], 200);
    }

    public function product_comment_private(Request $request,$id)
    {
        $comment = $this->productObject->getProductComment($id,auth()->user()->id);
        return response()->json([
            'success'=>true,
            'product_id' => $id,
            'product_comment'=>new CommentProductResource($comment)
        ], 200);
    }
}
