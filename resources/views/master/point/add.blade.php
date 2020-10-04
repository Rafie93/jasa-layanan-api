@extends('layouts.app')
@section('title', "Tambah Sistem Point")
@section('breadcrumb')
    <li><a href="{{Route("bank.index")}}">Sistem Point</a></li>
    <li>Tambah Sistem Point</li>

@endsection
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Form Tambah Sistem Point</h3></div>
            <div class="panel-body">
                {!! Form::open(['route'=>'point.store']) !!}
                {!! FormField::text('code', ['label' => 'Code*', 'required' => true]) !!}
                {!! FormField::text('name', ['label' => 'Nama*', 'required' => true]) !!}
                {!! FormField::text('point', ['label' => 'Point*', 'required' => true]) !!}
                {!! FormField::textarea('description', ['label' => 'Deskripsi']) !!}
                {!! Form::submit('SUBMIT', ['class'=>'btn btn-primary']) !!}

            </div>
        </div>
    </div>
</div>

@endsection
