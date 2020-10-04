<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Customer\Customer;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user = $this->resource;
        $customer = Customer::where('user_id',$user->id)->first();

        $userData = [
            'id'        => $user->id,
            'code'      => $customer->code ? $customer->code : '',
            'name'      => $user->name ? $user->name : '',
            'email'     => $user->email ?  $user->email :'',
            'phone'     => $user->phone,
            'tanggal_lahir'=>$user->birthday,
            // 'tanggal_lahir'=>$user->birthday ? ganti_format_tgl_indo($user->birthday):'',
            'orig_city_id'=>$customer->orig_city_id,
            'orig_district_id'=> $customer->orig_district_id,
            'postal_code' => $customer->postal_code,
            'category_user' => $customer->category_user,
            'address' => $customer->address ? $customer->address : '',
            'point'=>  $user->point,
            'ref_code'=>  $user->ref_code,
            'foto'  => $user->image(),
            'fcm_token' => $user->fcm_token ? $user->fcm_token : ''
        ];
        return $userData;
    }

    public function with($request)
    {
        if ($request->route()->getName() == 'api.login_member') {
            return ['success' => true, 'token' => $this->resource->createToken('nApp')->accessToken];
        }
        return [];
    }
}
