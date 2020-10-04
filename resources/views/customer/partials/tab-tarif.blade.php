<div class="tab-pane" id="tarif">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">List Tarif Khusus {{$customer->name}}</h3></div>
                <div class="panel-body">
                    <table class="table table-responsive table-bordered">
                        <thead>
                           <tr>
                            <th align="center">No</th>
                            <th align="center">Layanan</th>
                            <th align="center">Asal</th>
                            <th align="center">Tujuan</th>
                            <th align="center">Tarif Per Kg</th>
                            <th align="center">Tarif Per Koli</th>
                           </tr>
                        </thead>
                        <tbody>
                            @if ($tarifs->isEmpty()) <tr><td colspan="6">Tidak Ada Tarif Khusus</td></tr>
                            @else
                                @foreach ($tarifs as $key=>$rate)
                                    <tr>
                                        <td>{{ $tarifs->firstItem() + $key }}</td>
                                        <td>{{$rate->service->name}}</td>
                                        <td>{{$rate->origCity->name}}</td>
                                        <td>{{$rate->destCity->name}}</td>
                                        <td align="center">{{number_format($rate->rate_kg)}}</td>
                                        <td align="center">{{number_format($rate->rate_pc)}}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>

                    </table>
                    {{$tarifs->links()}}

                </div>
            </div>
        </div>


    </div>
</div>
