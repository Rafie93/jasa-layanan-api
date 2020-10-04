@inject('regionQuery', 'App\Models\Regions\RegionQuery')
@extends('layouts.app')
@section('title', "Edit Customer")
@section('breadcrumb')
    <li><i class="ace-icon fa fa-users home-icon"></i> <a href="{{Route("customer.index")}}">Customer</a></li>

    <li>Edit Customer</li>

@endsection
@section('content')
<div class="page-header">
    <h1> Customer<small><i class="ace-icon fa fa-angle-double-right"></i>Edit Customer (General, Perusahaan, Reseller) </small></h1>
</div>
{!! Form::model($customer, ['route' => ['customer.update', $customer->id],'method' => 'post']) !!}

<div class="row">
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Detail Customer</h3></div>
            <div class="panel-body">

                {!! FormField::select('category_user', $category,
                    ['label' => 'Kategori',
                     'placeholder' =>'Kategori Customer',
                     'value' => $customer->category_user,
                     'required' => true]) !!}

                {!! FormField::text('name', ['label' => 'Nama*', 'required' => true, 'value' => $customer->name]) !!}
                {!! FormField::text('code', ['label' => 'Code', 'value' => $customer->code]) !!}
                {!! FormField::text('nik', ['label' => 'NIK','value' => $customer->nik]) !!}
                {!! FormField::text('npwp', ['label' => 'NPWP','value' => $customer->npwp]) !!}
                {!! FormField::text('name_customer', ['label' => 'Nama Customer*', 'required' => true,'value' => $customer->name_customer]) !!}
                {!! FormField::text('phone_customer', ['label' => 'Phone Customer*', 'required' => true,'value' => $customer->phone_customer]) !!}
                {!! FormField::email('email_customer', ['label' => 'Email Customer*', 'required' => true,'value' => $customer->email_customer]) !!}

                {!! FormField::select('is_active', [
                    '1' => 'Aktif',
                    '0' => 'Non Aktif'],
                     [
                    'label' => 'Status',
                    'placeholder' => 'Status',
                    'value' => $customer->is_active]) !!}

            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Alamat Customer</h3></div>
            <div class="panel-body">
                {!! FormField::select('province_id', $regionQuery->getProvincesList(), [
                    'label' => 'Provinsi*',
                    'placeholder' => 'Provinsi',
                    'class'=>'select2']) !!}
                {!! FormField::select('orig_city_id', $regionQuery->getCitiesList(old('province_id')), [
                     'label' => 'Kota*',
                     'placeholder' => 'Kota',
                     'value' => $customer->orig_city_id,
                     'required' => true,
                     'class'=>'select2']) !!}
                {!! FormField::select('orig_district_id', $regionQuery->getDistrictsList($customer->orig_city_id), [
                    'label' => 'Kecamatan',
                    'placeholder' => 'Kecamatan',
                    'class'=>'select2',
                    'value' => $customer->orig_district_id]) !!}
                {!! FormField::textarea('address', ['label' => 'Alamat','value' => $customer->address]) !!}
                {!! FormField::text('postal_code', ['label' => 'Kode POS','value' => $customer->postal_code]) !!}

            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Account Login</h3></div>
            <div class="panel-body">
                {!! FormField::text('birthday', [
                    'label' => "Tanggal Lahir",
                    'class' => 'form-control tanggal',
                    'value' => $customer->user->birthday
                ]) !!}
                {!! FormField::text('username', ['label' => 'Username Login*', 'required' => true,'value'=>$customer->user->username]) !!}
                {!! FormField::email('email', ['label' => 'Email Login*', 'required' => true,'value'=>$customer->user->email]) !!}
                {!! FormField::password('password', ['label' => 'Password Login*','placeholder'=>'Kosongkan jika tidak ingin mengubah password']) !!}

            </div>
        </div>
    </div>


</div>
<div class="panel-footer">
    {!! Form::submit('UPDATE', ['class'=>'btn btn-primary']) !!}
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
                $("#orig_city_id").html(string);
            }
        );
    });

    $("#orig_city_id").change(function(e) {
        var orig_city_id = $("#orig_city_id").val();
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
                $("#orig_district_id").html(string);
            }
        );
    });

})();
</script>
@endsection
