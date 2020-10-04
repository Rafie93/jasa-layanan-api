<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products\Category;
use App\Http\Resources\Products\CategoryList as CategoryListResource;

class CategoryController extends Controller
{
    public function getCategoryParent(Request $request)
    {
       $category = Category::whereNull('parent_id')->get();
       return response()->json([
            'success'=>true,
            'category'=> $category
        ], 200);
    }

    public function getCategorySub(Request $request)
    {
       $category = Category::whereNotNull('parent_id')->get();
       return response()->json([
            'success'=>true,
            'sub_category'=> new CategoryListResource($category)
        ], 200);
    }
}
