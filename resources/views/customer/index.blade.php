@extends('layouts.app')
@section('title', "Daftar Customer")
@section('breadcrumb')
    <li><i class="ace-icon fa fa-users home-icon"></i> Customer</li>
@endsection
@section('content')

@include('customer.partials.header')

<div class="panel panel-default table-responsive">
    <div class="panel-heading"><h3 class="panel-title">Data Customer</h3></div>
    <table class="table table-bordered table-hover">
        <thead>
            <th class="text-center">#</th>
            <th class="text-center">Name</th>
            <th class="text-center">Kategori</th>
            <th class="text-center">Code / Ref Code</th>
            <th class="text-center">Kota / Kecamatan</th>
            <th class="text-center">PIC</th>
            <th class="text-center">Point</th>
            <th class="text-center">Status</th>
            <th class="text-center">Aksi</th>

        </thead>
        <tbody>
            @if ($customers->isEmpty())
                <tr>
                    <td colspan="9">Tidak ada data</td>
                </tr>
            @else
                @foreach($customers as $key => $customer)
                <tr>
                    <td class="text-center">{{ $customers->firstItem() + $key }}</td>
                    <td ><a href="#">
                        <a href="{{Route('customer.detail',$customer->id)}}"> {{ $customer->name }}</a>
                        @if($customer->npwp!=null)<br>{{"NPWP :".$customer->npwp}} @endif</td>
                    <td >{{ $customer->isCategory() }}</td>
                    <td >{{ 'Code : '.$customer->code}}<br>{{'Ref Code : '.$customer->user->ref_code }}</td>
                    <td> @if($customer->orig_city_id!=null){{$customer->isCity->name}} <br> @endif
                        @if($customer->orig_district_id!=null){{$customer->isDistrict->name}} @endif
                    </td>
                    <td >{{  "Nama :".$customer->name_customer}}
                            <br>{{'Phone :'.$customer->phone_customer }}
                            <br>{{'Email :'.$customer->email_customer }}</td>
                    <td class="text-center">{{$customer->user->point}}</td>
                    <td class="text-center">{{ $customer->isAktif() }}</td>
                    <td>
                        <a href="{{Route('customer.edit',$customer->id)}}" class="btn btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
{{$customers->appends(request()->except('page'))->links()}}

@endsection
