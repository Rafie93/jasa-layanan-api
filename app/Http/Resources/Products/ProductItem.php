<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Products\ProductPrice;
use App\Models\Products\Category;
class ProductItem extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $categoryId = $this->resource->category_id;
        $category = Category::where('id',$categoryId)->first();
        $category_parent_id = 0;
        $category_parent = "";
        if($category->parent_id != null){
            $parent = Category::where('id',$category->parent_id)->first();
            $category_parent_id = $category->parent_id;
            $category_parent = $parent->name;
        };

        return  [
            'id'      => $this->resource->id,
            'code'     => $this->resource->code,
            'name' =>  $this->resource->name,
            'description'      => $this->resource->description,
            'merk'     => $this->resource->merk,
            'price' =>  $this->resource->price,
            'thumbnail'  => $this->resource->thumbnail(),
            'image_list' =>  $this->resource->image,
            'category_id' => $categoryId,
            'category_name' => $this->resource->category->name,
            'category_parent_id' => $category_parent_id,
            'category_parent_name' => $category_parent,
            'variant' => ProductPrice::where('product_id',$this->resource->id)->get()
        ];
    }
}
