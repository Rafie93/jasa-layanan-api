@inject('regionQuery', 'App\Models\Regions\RegionQuery')
@extends('layouts.app')
@section('title', "Tambah Vendor")
@section('breadcrumb')
    <li><i class="ace-icon fa fa-users home-icon"></i> <a href="{{Route("vendor.index")}}">Vendor</a></li>
    <li>Tambah Vendor</li>
@endsection
@section('content')
<div class="page-header">
    <h1> Vendor<small><i class="ace-icon fa fa-angle-double-right"></i>Tambah data Vendor </small></h1>
</div>

{!! Form::open(['route'=>'vendor.store']) !!}

<div class="row">
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Detail Vendor</h3></div>
            <div class="panel-body">

                {!! FormField::text('name', ['label' => 'Nama*', 'required' => true,'placholder'=>' Nama Vendor']) !!}
                {!! FormField::text('phone', ['label' => 'Phone*', 'required' => true,'placholder'=>' Phone Vendor']) !!}
                {!! FormField::text('email', ['label' => 'Email*', 'required' => true,'placholder'=>' Email Vendor']) !!}
                {!! FormField::select('is_active', [
                    '1' => 'Aktif',
                    '0' => 'Non Aktif'],
                     [
                    'label' => 'Status',
                    'placeholder' => 'Status',
                    'value' => 1]) !!}
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Alamat Vendor</h3></div>
            <div class="panel-body">
                {!! FormField::select('province_id', $regionQuery->getProvincesList(), [
                    'label' => 'Provinsi*',
                    'placeholder' => 'Provinsi',
                    'class'=>'select2']) !!}
                {!! FormField::select('city_id', $regionQuery->getCitiesList(old('province_id')), [
                     'label' => 'Kota*',
                     'placeholder' => 'Kota',
                     'required' => true,
                     'class'=>'select2']) !!}
                {!! FormField::select('district_id', $regionQuery->getDistrictsList(), ['label' => 'Kecamatan', 'placeholder' => 'Kecamatan','class'=>'select2']) !!}
                {!! FormField::textarea('address', ['label' => 'Alamat']) !!}
                {!! FormField::text('postal_code', ['label' => 'Kode POS']) !!}

            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">PIC</h3></div>
            <div class="panel-body">
                {!! FormField::text('pic_name', ['label' => 'Nama PIC*', 'required' => true]) !!}
                {!! FormField::text('pic_phone', ['label' => 'Phone PIC*', 'required' => true]) !!}
                {!! FormField::email('pic_email', ['label' => 'Email PIC*', 'required' => true]) !!}

            </div>
        </div>
    </div>

</div>
<div class="panel-footer">
        {!! Form::submit('SUBMIT', ['class'=>'btn btn-primary']) !!}
    {!! Form::close() !!}

</div>

@endsection

@section('footer')
<script>
(function() {
    $.ajaxSetup({
        headers: {}
    });
    $("#category").change(function(e) {
        var category = $("#category").val();
        if (category==1){
            $("#name").attr("placeholder", "Nama Perusahaan");
        }else{
            $("#name").attr("placeholder", "Nama Personal");
        }
    });
    $("#province_id").change(function(e) {
        var province_id = $("#province_id").val();
        if (province_id == '') return false;
        $.get(
            "{{ route('api.regions.cities') }}",
            {
                province_id: province_id
            },
            function(data) {
                var string = '<option value="">-- Kota --</option>';
                $.each(data, function(index, value) {
                    string = string + `<option value="` + index + `">` + value + `</option>`;
                })
                $("#city_id").html(string);
            }
        );
    });

    $("#city_id").change(function(e) {
        var orig_city_id = $("#city_id").val();
        if (orig_city_id == '') return false;
        $.get(
            "{{ route('api.regions.districts') }}",
            {
                city_id: orig_city_id
            },
            function(data) {
                var string = '<option value="">-- Kecamatan --</option>';
                $.each(data, function(index, value) {
                    string = string + `<option value="` + index + `">` + value + `</option>`;
                })
                $("#district_id").html(string);
            }
        );
    });

})();
</script>
@endsection
