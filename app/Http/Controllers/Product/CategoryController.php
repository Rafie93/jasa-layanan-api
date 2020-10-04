<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products\Category;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
       $category = Category::whereNull('parent_id')->get();
       $subcategory = Category::orderBy('parent_id','asc')
                                ->whereNotNull('parent_id')
                                ->get();
       return view('category.index',compact('category','subcategory'));
    }
}
