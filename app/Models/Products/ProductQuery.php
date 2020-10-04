<?php

namespace App\Models\Products;

use App\Models\Products\Category;
use App\Models\Products\Product;
use App\Models\Products\ProductPrice;
use Illuminate\Support\Str;
use App\Models\Products\ProductComment;

class ProductQuery
{
  public function getProduct($request,$sortId="id",$sortBy="desc",$limit="20")
  {
    $products = Product::orderby($sortId,$sortBy)
                    ->where(function($query) use ($request){
                        $query->where('status', '=',1);
                        $query->where('is_active','=', 1);
                    })
                    ->when($request->filterKategori, function ($query) use ($request) {
                        $categoryCheck = Category::where('id',$request->filterKategori)->first();
                        if($categoryCheck->parent_id==null){
                            $all_category =  Category::where('parent_id',$request->filterKategori)->get();
                            $query->whereIn('category_id', $all_category->toArray());
                        }else{
                            $query->where('category_id', '=', "{$request->filterKategori}");
                        }
                    })
                    ->when($request->keyword, function ($query) use ($request) {
                            $query->where('name', 'like', "%{$request->keyword}%");
                    });
    if($limit=="all"){
        $products = $products->get();
    }else{
        $products = $products->paginate($limit);
    }

    return $products;
  }

  public function getProductDetail($id)
  {
    $product = Product::where('id',$id)->first();
    return $product;
  }

  public function getProductVariant($productId)
  {
      return ProductPrice::where('product_id',$productId)->get();
  }
  public function getProductComment($productId,$by='all')
  {
    $cooment = ProductComment::orderBy('id','asc')->where('product_id',$productId)->paginate(50);
    if($by!='all'){
        $cooment = ProductComment::orderBy('id','asc')
                                ->where(function($query) use ($by){
                                    $query->where('to',$by)->orWhere('creator_id', '=',$by);
                                })
                                ->where('product_id',$productId)->get();
    }
    return $cooment;
  }
   public function draft()
   {
       $code = $this->generateCode(10);
       $draftData = array(
           'category_id' => 1,
           'creator_id' => auth()->user()->id,
           'status' => 0,
           'name' => '',
           'code' => $code,
           'is_active'=>0
       );
      $products = Product::updateOrInsert([
        'creator_id' => auth()->user()->id,
        'status' => 0,
        'is_active'=>0
      ],
      $draftData);

      $updatedOrInsertedRecord = Product::orderBy('id','desc')
                                        ->where('is_active', 0)
                                        ->where('creator_id', auth()->user()->id)
                                        ->where('status',0)
                                        ->first();
      return $updatedOrInsertedRecord;
   }

   public function update($request,$id)
   {
      $price = $request->price==null ? 0 : $request->price;
      $price_modal = $request->price_modal==null ? 0 : $request->price_modal;

      $request->merge(['is_active'=>1,'price'=>$price]);

      if ($request->hasFile('img')) {
        $nama_file = $request->code.'-'.$request->file('img')->getClientOriginalName();
        $request->file('img')->move('images/products/'.$id,$nama_file);
        $request->merge(['thumbnail'=>$nama_file]);
    }
      $product = Product::find($id)->update($request->all());


      $productVarian = array(
        'product_id' => $id,
        'price_modal' => $price_modal,
        'bahan'=> $request->bahan,
        'ukuran'=> $request->ukuran,
        'price'=> $price,
        'pieces_price' => $request->satuan
      );

      ProductPrice::updateOrInsert($productVarian,$productVarian);
   }

   public function generateCode($val)
   {
       $code = Str::random($val);
       return $code;
   }

}
