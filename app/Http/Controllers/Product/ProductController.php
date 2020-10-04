<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products\ProductQuery;
use App\Models\Products\Product;

class ProductController extends Controller
{
    public function __construct(ProductQuery $queryObject)
    {
        $this->queryObject = $queryObject;
    }

    public function index(Request $request)
    {
        $products = $this->queryObject->getProduct($request);
        return view('products.index',compact('products'));
    }
    public function add(Request $request)
    {
        $product = $this->queryObject->draft();
        return view('products.add',compact('product'));
    }
    public function detail(Request $request,$id)
    {
        $product = Product::where('id',$id)->first();
        return view('products.detail',compact('product'));
    }
    public function edit(Request $request,$id)
    {
        $product = Product::where('id',$id)->first();
        return view('products.edit',compact('product'));
    }
    public function store(Request $request,$id)
    {

        $this->queryObject->update($request,$id);
        logCreate(auth()->user()->id,$request->name.' - '.$request->code,'Product');
        return redirect()->route('products.index')->with('sukses','Data Berhasil disimpan');

    }
    public function update(Request $request,$id)
    {
        $this->queryObject->update($request,$id);
        logUpdate(auth()->user()->id,$request->name.' - '.$request->code,'Product');
        return redirect()->route('products.index')->with('sukses','Data Berhasil disimpan');

    }
}
