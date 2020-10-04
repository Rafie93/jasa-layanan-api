@extends('layouts.app')
@section('title', "Edit Sistem Point")
@section('breadcrumb')
    <li><a href="{{Route("point.index")}}">Sistem Point</a></li>
    <li>Edit Sistem Point</li>

@endsection
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Form Edit Sistem Point</h3></div>
            <div class="panel-body">
                {!! Form::model($point, ['route' => ['point.update', $point->id],'method' => 'post']) !!}

                {!! FormField::text('code', ['label' => 'Code*', 'required' => true,'value'=>$point->code]) !!}
                {!! FormField::text('name', ['label' => 'Nama*', 'required' => true,'value'=>$point->name]) !!}
                {!! FormField::text('point', ['label' => 'Point*', 'required' => true,'value'=>$point->point]) !!}
                {!! FormField::textarea('description', ['label' => 'Deskripsi','value'=>$point->description]) !!}

                {!! Form::submit('SUBMIT', ['class'=>'btn btn-primary']) !!}

            </div>
        </div>
    </div>
</div>

@endsection
