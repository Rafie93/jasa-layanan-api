{{-- @inject('awbQuery', 'App\Models\Awb\AwbQuery') --}}

@extends('layouts.app')
@section('title', "Daftar Invoice tunai")
@section('breadcrumb')
<li><a href="{{Route('invoice.tunai')}}"><i class="ace-icon fa fa-money home-icon"></i>Invoice tunai</a></li>
    <li>Invoice tunai Kepada {{request('customer_id')}}</li>

@endsection
@section('content')
{!! Form::open(['route'=>'invoice.tunai.customer.store']) !!}
{{ Form::hidden('customer_id', request('customer_id'),array('id'=>'customer_id')) }}

<div class="row">
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Invoice Tunai Baru</h3></div>
            <div class="panel-body">


            <label class="form-label">Invoice No.</label>
            {!! Form::text('number', null,array(
                'class' => 'form-control',
                'value' => request('number')
            )) !!}
            <i>Kosongkan jika ingin <strong>No. Invoice</strong> otomatis</i><br><br>

            {!! FormField::text('date', [
                'label' => "Tanggal Invoice",
                'class' => 'tanggal',
                'value' =>  request('date') ? request('date') : date('Y-m-d'),
                'required' => true,
            ]) !!}



            {!! FormField::text('discount', [
                'label' => "Diskon",
                'class' => 'text-right',
                'value' =>  request('discount') ? request('discount') : 0
            ]) !!}

            {!! FormField::text('administrasi_cost', [
                'label' => "Administrasi",
                'class' => 'text-right',
                'value' =>  request('administrasi_cost') ? request('administrasi_cost') : 0
            ]) !!}


            {!! FormField::textarea('notes', [
                'label' => "Catatan Invoice",
                'class' => 'form-control',
                'value' => request('notes')
            ]) !!}


            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title">Daftar Belum Invoice</h3></div>
            <div class="panel-body">
                {{-- <table class="table table-bordered table-hover">
                    <thead>
                        <th class="text-center">#</th>
                        <th class="text-center">No. Pesanan</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Tujuan</th>
                        <th class="text-center">Penerima</th>
                        <th class="text-center">Layanan</th>
                        <th class="text-center">Berat</th>
                        <th class="text-center">Total</th>

                    </thead>
                    <tbody>
                        @php
                            $listAwb = $awbQuery->getAwbByCustomer(request('customer_id'),1);
                        @endphp
                        @foreach ($listAwb as $item)
                            <tr>
                                <td>
                                    {!! Form::checkbox('awbCek[]', $item->id,true);!!}
                                </td>
                                <td>{{$item->number}}</td>
                                <td>{{$item->created_at->format('d M Y')}}</td>
                                <td>{{$item->destCity->name}}</td>
                                <td>{{$item->getConsignee()['name']}}</td>
                                <td>{{$item->service->name}}</td>
                                <td align="center">{{$item->weight}}</td>
                                <td align="right">{{number_format($item->amount)}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table> --}}
            </div>
        </div>
    </div>
</div>
<div class="panel-footer">
    {!! Form::submit('SUBMIT', [
        'class'=>'btn btn-primary',
        ]) !!}
    {!! Form::close() !!}

</div>

@endsection
