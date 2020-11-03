@inject('awbQuery', 'App\Models\Awb\AwbQuery')

@extends('layouts.app')
@section('title', "List AWB Belum Invoice")
@section('breadcrumb')
<li><a href="{{ request()->segment(2)=="kredit" ? Route('invoice.kredit') : Route('invoice.tunai') }}">
    <i class="ace-icon fa fa-money home-icon"></i>
    Invoice {{ request()->segment(2)=="kredit" ? 'Kredit' : 'Tunai'}}</a>
</li>
    <li>List AWB Belum Invoice</li>
@endsection
@section('content')
<div class="panel panel-default table-responsive">
    <div class="panel-heading"><h3 class="panel-title">Daftar AWB Belum Invoice</h3></div>
    <table class="table table-bordered table-hover">
        <thead>
            <th class="text-center">#</th>
            <th  class="text-center">Aksi</th>
            <th class="text-center">No. AWB</th>
            <th class="text-center">Tanggal</th>
            <th class="text-center">Pengirim</th>
            <th class="text-center">Penerima</th>
            <th class="text-center">Tujuan</th>
            <th class="text-center">Layanan</th>
            <th class="text-center">Berat</th>
            <th class="text-center">Total</th>

        </thead>
        <tbody>
            @php $awbs = request()->segment(2)=="kredit" ? $awbQuery->getListAwbBelumInvoiceKredit() : $awbQuery->getListAwbBelumInvoiceTunai()  @endphp
           @if ($awbs->isEmpty()) <tr><td colspan="11">Tidak Ada Data</td></tr>
           @else
                @foreach ($awbs as $key=>$awb)
                    <tr>
                        <td class="text-center">{{ 1 + $key }}</td>
                        <td>
                            @if(request()->segment(2)=="kredit")
                            <a href="{{Route('invoice.kredit.create',['number_awb' => $awb->number])}}" class="btn btn-info btn-sm">
                                <i class="glyphicon glyphicon-edit"></i> Buat Invoice</a>
                            @else
                            <a href="{{Route('invoice.tunai.create',['number_awb' => $awb->number])}}" class="btn btn-info btn-sm">
                                <i class="glyphicon glyphicon-edit"></i> Buat Invoice</a>
                            @endif
                        </td>

                        <td class="text-center">
                           {{$awb->number}}
                        </td>
                        <td>{{$awb->created_at}}</td>
                        <td>
                            @if($awb->customer_id != 0) {{$awb->customer->name}}<br> @endif
                            {{$awb->getConsignor()['name']}}
                        </td>
                        <td>{{$awb->getConsignee()['name'].' |'.$awb->getConsignee()['phone']}}</td>
                        <td>{{$awb->destCity->name}}</td>
                        <td class="text-center">{{$awb->service->name}}</td>
                        <td class="text-center">{{$awb->weight}}</td>
                        <td align="right">{{number_format($awb->amount)}}</td>
                    </tr>
                @endforeach
           @endif
        </tbody>
    </table>
</div>
@endsection
