{{-- @inject('awbQuery', 'App\Models\Awb\AwbQuery') --}}

@extends('layouts.app')
@section('title', "List AWB Belum Invoice")
@section('breadcrumb')
<li><a href="{{ request()->segment(2)=="kredit" ? Route('invoice.kredit') : Route('invoice.tunai') }}">
    <i class="ace-icon fa fa-money home-icon"></i>
    Invoice {{ request()->segment(2)=="kredit" ? 'Kredit' : 'Tunai'}}</a>
</li>
    <li>List  Belum Invoice</li>
@endsection
@section('content')
<div class="panel panel-default table-responsive">
    <div class="panel-heading"><h3 class="panel-title">Daftar Customer</h3></div>
    <table class="table table-bordered table-hover">
        <thead>
            <th class="text-center">#</th>
            <th  class="text-center">Aksi</th>
            <th class="text-center">Total Tagihan</th>
            <th class="text-center">Belum Invoice</th>
            <th class="text-center">Nama Customer</th>


        </thead>
        {{-- <tbody>
            @php $awbs = request()->segment(2)=="kredit" ? $awbQuery->getListCustomerBelumInvoiceKredit() : $awbQuery->getListCustomerBelumInvoiceTunai()  @endphp
           @if ($awbs->isEmpty()) <tr><td colspan="11">Tidak Ada Data</td></tr>
           @else
                @foreach ($awbs as $key=>$awb)
                    <tr>
                        <td class="text-center">{{ 1 + $key }}</td>
                        <td>
                            @if(request()->segment(2)=="kredit")
                            <a href="{{Route('invoice.kredit.customer',['customer_id' => $awb->customer_id])}}" class="btn btn-info btn-sm">
                                <i class="glyphicon glyphicon-edit"></i> Buat Invoice Customer</a>
                            @else
                            <a href="{{Route('invoice.tunai.customer',['customer_id' => $awb->customer_id])}}" class="btn btn-info btn-sm">
                                <i class="glyphicon glyphicon-edit"></i> Buat Invoice Customer</a>
                            @endif
                        </td>

                        <td class="text-center">
                           {{number_format($awb->amount)}}
                        </td>
                        <td class="text-center"> {{number_format($awb->total)}}</td>
                        <td>@if($awb->customer_id != 0) {{$awb->name}}<br> @endif</td>
                        <td>{{$awb->kantor}}</td>


                    </tr>
                @endforeach
           @endif
        </tbody> --}}
    </table>
</div>
@endsection
