<?php

namespace App\Http\Controllers\Rates;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rates\Rate;
use  App\Models\Regions\City;
use  App\Models\Regions\District;

class RatesController extends Controller
{
    public function index(Request $request)
    {

        $destCity = null;
        $origCityId = $request->get('orig_city_id', auth()->user()->branch->city_id);
        $serviceId = $request->get('service_id', 1);
        $customerId = $request->get('customer_id', 0);
        $destProvId = $request->get('dest_province_id',0);
        $cityId = $request->get('city_id', 0);

        $cityList = City::whereProvinceId($destProvId)->with('rates')->withCount('districts')->get();


        return view('rates.rate-basic', compact('origCityId', 'serviceId', 'destCity', 'customerId','cityList','destProvId','cityId'));
    }
    public function districts(Request $request)
    {
        $origCityId = $request->get('orig_city_id', auth()->user()->branch->city_id);
        $serviceId = $request->get('service_id', 1);
        $customerId = $request->get('customer_id', 0);
        $destProvId = $request->get('dest_province_id',0);
        $cityId = $request->get('city_id', 0);

        $cityList = City::whereProvinceId($destProvId)->with('rates')->withCount('districts')->get();
        $destCity = District::where('city_id',$cityId)->get();

        return view('rates.rate-basic', compact('origCityId', 'serviceId', 'destCity', 'customerId','cityList','destProvId','cityId'));


    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'orig_city_id'      => 'required|numeric',
            'service_id'        => 'required|numeric',
            'customer_id'       => 'required|numeric',
            'rate.*.rate_kg'         => 'nullable|numeric',
            'rate.*.rate_pc'         => 'nullable|numeric',
            'rate.*.min_weight' => 'required_with:rate.*.rate_kg,rate.*.rate_pc',
            'rate.*.etd'        => 'required_with:rate.*.rate_kg,rate.*.rate_pc',
        ], [
            'rate.*.rate_kg.numeric'               => 'Harus berupa Angka.',
            'rate.*.rate_pc.numeric'               => 'Harus berupa Angka.',
            'rate.*.min_weight.required_with' => 'Wajib diisi.',
            'rate.*.etd.required_with'        => 'Wajib diisi.',
        ]);

        $updatedCount = $this->updateRateData($request->only('orig_city_id', 'service_id', 'rate', 'customer_id'));

        if($request->city_id==""){
            return redirect()->route('rates.index',[
            'orig_city_id'=>$request->orig_city_id,
            'service_id'=> $request->service_id,
            'customer_id' => $request->customer_id,
            'dest_province_id'=>$request->dest_province_id,
            ])
            ->with('sukses',$updatedCount.' Tarif Sudah Diperbaharui');
        }else{
            return redirect()->route('rates.districts',[
                'city_id' => $request->city_id,
                'orig_city_id'=>$request->orig_city_id,
                'service_id'=> $request->service_id,
                'customer_id' => $request->customer_id,
                'dest_province_id'=>$request->dest_province_id,
                ])
                ->with('sukses',$updatedCount.' Tarif Sudah Diperbaharui');
        }


    }


    public function updateRateData($ratesData)
    {
        $updatedCount = 0;
        $rate = ($ratesData['rate']);
        $orig_city_id = $ratesData['orig_city_id'];
        $service_id = $ratesData['service_id'];
        $customer_id = $ratesData['customer_id'];

        foreach ($rate as $destId => $value) {
            if (strlen($destId) == 7) {
                $rate =Rate::firstOrNew([
                    'orig_city_id'     => $orig_city_id,
                    'orig_district_id' => '0',
                    'dest_city_id'     => substr($destId, 0, 4),
                    'dest_district_id' => $destId,
                    'service_id'       => $service_id,
                    'customer_id'      => $customer_id,
                ]);
            } else {
                $rate = Rate::firstOrNew([
                    'orig_city_id'     => $orig_city_id,
                    'orig_district_id' => '0',
                    'dest_city_id'     => $destId,
                    'dest_district_id' => '0',
                    'service_id'       => $service_id,
                    'customer_id'      => $customer_id,
                ]);
            }
            if ($value['rate_kg'] || $value['rate_pc']) {
                $rate->rate_kg = $value['rate_kg'];
                $rate->rate_pc = $value['rate_pc'];
                $rate->min_weight = $value['min_weight'];
                $rate->etd = $value['etd'];
                $rate->save();
                $updatedCount++;
            } elseif (!$value['rate_kg'] && !$value['rate_pc'] && !$value['min_weight'] && !$value['etd']) {
                if ($rate->exists && $rate->dest_district_id) {
                    $rate->delete();
                }
            }
        }
        return $updatedCount;
    }


}
