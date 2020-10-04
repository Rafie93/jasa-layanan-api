@extends('layouts.app')
@section('title', "Edit News")
@section('breadcrumb')
    <li><a href="{{Route("news.index")}}">News</a></li>
    <li>Edit News</li>

@endsection
@section('content')
<div class="page-header">
    <h1> News<small><i class="ace-icon fa fa-angle-double-right"></i>Edit data News guna untuk menampilkan News pada app customer </small></h1>
</div>
{!! Form::model($news, ['route' => ['news.update', $news->id],'method' => 'post','enctype' => 'multipart/form-data']) !!}
<div class="row">
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Title News</h3></div>
            <div class="panel-body">
                <img src="{{$news->thumbnail() }}" style="height: 100px" >
                {!! FormField::file('thumbnails') !!}
                {!! FormField::text('title', ['label' => 'Judul Berita*', 'required' => true,'value'=>$news->title]) !!}
                {!! FormField::text('category', ['label' => 'Kategori Berita','value'=>$news->category_news]) !!}
                {!! FormField::select('is_status',['0'=>'Draft','1'=>'Publish'],
                    [
                    'label' => 'Status',
                    'required' => true,
                    'value' => request('status') ?  request('status') : $news->is_status
                    ]) !!}
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Isi Berita</h3></div>
            <div class="panel-body">
                <textarea name="description" id="editor">{{$news->description}}</textarea>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="panel-footer">
        {!! Form::submit('SUBMIT', ['class'=>'btn btn-primary']) !!}
    </div>
</div>

@endsection
@section('footer')
<script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
<script>
CKEDITOR.replace('editor', {
        height  : '190px',
        filebrowserUploadUrl: "",
        filebrowserUploadMethod: 'form'
    });
</script>
@endsection
