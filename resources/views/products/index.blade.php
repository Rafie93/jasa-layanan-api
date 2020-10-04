@extends('layouts.app')
@section('title', "Produk")

@section('breadcrumb')
<li class="active"><i class="ace-icon fa fa-home home-icon"></i><a href="/product">Product</a></li>
@endsection
@section('content')
<div class="page-header">
    <h1> List Produk<small>     <i class="ace-icon fa fa-angle-double-right"></i> tambah produk, beserta macam-macam ukuran dan harganya </small></h1>
</div>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-body">
                @include('products.partials.header')


                 <table class="table table-responsive table-bordered">
                    <thead>
                        <tr>
                            <td align="center">No</td>
                            <td align="center">Thumbnail</td>
                            <td align="center">Kategori</td>
                            <td align="center">Code</td>
                            <td align="center">Nama</td>
                            <td align="center">Merk</td>
                            <td align="center">Harga Modal</td>
                            <td align="center">Harga Jual</td>
                            <td align="center">View</td>
                            <td align="center">Edit</td>
                            <td align="center">Delete</td>
                        </tr>

                    </thead>
                    <tbody>
                        @if ($products->isEmpty())
                            <tr><td colspan="10">Tidak ada data</td></tr>
                        @else
                            @foreach($products as $key => $product)
                            <tr>
                                <td class="text-center">{{ $products->firstItem() + $key }}</td>
                                <td align="center"><img src="{{ $product->thumbnail() }}" width="100px" height="50px"></td>
                                <td>{{$product->category->name}}</td>
                                <td>{{$product->code}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->merk}}</td>
                                <td align="right">{{number_format($product->price)}}</td>
                                <td align="right">{{number_format($product->price)}}</td>
                                <td align="center">
                                    <a href="{{Route('products.detail',$product->id)}}" class="btn btn-info"><i class="glyphicon glyphicon-eye-open"></i></a>
                                </td>
                                <td align="center">
                                    <a href="{{Route('products.edit',$product->id)}}" class="btn btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                                </td>
                                <td align="center">
                                    <a href="{{Route('products.edit',$product->id)}}" class="btn btn-danger"><i class="glyphicon glyphicon-edit"></i></a>
                                </td align="center">
                            </tr>
                            @endforeach
                        @endif

                    </tbody>
                </table>

            </div>
            {{$products->appends(request()->except('page'))->links()}}

        </div>
    </div>

</div>


@endsection

