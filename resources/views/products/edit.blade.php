@inject('categoryQuery', 'App\Models\Products\CategoryQuery')
@inject('vendorQuery', 'App\Models\Vendors\VendorQuery')

@extends('layouts.app')
@section('title', "Edit Produk")

@section('breadcrumb')
<li><i class="ace-icon fa fa-home home-icon"></i><a href="{{Route('products.index')}}">Product</a></li>
<li class="active">Edit Product</li>
@endsection
@section('content')
<div class="page-header">
    <h1> Edit Produk<small> <i class="ace-icon fa fa-angle-double-right"></i> Edit produk, beserta macam-macam ukuran dan harganya </small></h1>
</div>
{!! Form::model($product, ['route' => ['products.update', $product->id],'method' => 'post','enctype' => 'multipart/form-data']) !!}

<div class="row">

    <div class="col-md-5">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Edit Product {{$product->name}}</h3></div>
            <div class="panel-body">

                <div class="form-group">
                    <label for="thumbnail" class="form-label">Thumbnail</label><br>
                    <img src="{{$product->thumbnail() }}" style="height: 100px" >
                    {!! Form::file('img') !!}

                </div>

                {!! FormField::select('category_id',$categoryQuery->getCategoryPluck(),
                    [
                    'label' => 'Category Layanan',
                    'placeholder' => '',
                    'required' => true,
                    'value' => request('category_id') ?  request('category_id') :  $product->category_id
                    ]) !!}


                {!! FormField::text('code', [
                    'label' => "Code Product",
                    'class' => 'text-left',
                    'value' =>  request('code') ? request('code') :  $product->code
                ]) !!}

                {!! FormField::text('name', [
                    'label' => "Name Product",
                    'class' => 'text-left',
                    'value' =>  request('name') ? request('name') :  $product->name,
                    'required' => true,
                ]) !!}


                {!! FormField::text('merk', [
                    'label' => "Merk",
                    'class' => 'text-left',
                    'value' =>  request('merk') ? request('merk') : $product->merk
                ]) !!}

                {!! FormField::select('vendor_id',$vendorQuery->getVendorPluck(),
                [
                'label' => 'Vendor / Penyedia',
                'placeholder' => 'kosongkan jika tidak ada',
                'value' => request('vendor_id') ?  request('vendor_id') :  ''
                ]) !!}


                {!! FormField::radios('display_price', ['0' => 'Ya', '1' => 'Tidak']) !!}

                {!! FormField::select('status',['0'=>'Draft','1'=>'Publish'],
                    [
                    'label' => 'status',
                    'required' => true,
                    'value' => request('status') ?  request('status') :  $product->status
                    ]) !!}


            </div>
        </div>
    </div>
    <div class="col-md-7">
        {!! FormField::textarea('description', [
            'label' => "Description",
            'id' => "editor",
            'class' => 'form-control',
            'value' => request('description') ? request('description') : $product->description
        ]) !!}

        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-add-price" data-toggle="tab">Price</a></li>
            <li><a href="#tab-add-image" data-toggle="tab">Image</a></li>

        </ul>
        <div class="tab-content">
            @include('products.partials.add-price')
            @include('products.partials.add-image')

        </div>
    </div>

</div>
<div class="panel-footer">
    {!! Form::submit('SUBMIT', [
        'class'=>'btn btn-success',
        ]) !!}
</div>
{!! Form::close() !!}

@endsection
@section('footer')
<script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>

<script type="text/javascript">
CKEDITOR.replace('editor', {
        height  : '150px',
        filebrowserUploadUrl: "",
        filebrowserUploadMethod: 'form'
    });
function isNumberKey(evt)
{
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;

        return true;
}
(function() {

})
function addPrice(){
    alert('tess');
}
</script>
@endsection
