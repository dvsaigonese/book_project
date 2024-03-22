<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class GHNController extends Controller
{
    public function getProvince(){
        return $this->getResponse('https://online-gateway.ghn.vn/shiip/public-api/master-data/province', '');
    }
    public function getDistrict($province_id){
        return $this->getResponse('https://online-gateway.ghn.vn/shiip/public-api/master-data/district', ['province_id' => $province_id]);
    }
    public function getWard($district_id){
        return $this->getResponse('https://online-gateway.ghn.vn/shiip/public-api/master-data/ward', ['district_id' => $district_id]);
    }

    public function getResponse($url, $parameters){
        $response = Http::withHeader('token', \Config::get('app.ghn'))->get($url, $parameters);
        if ($response->ok()) {
            return $response->json();
        } else {
            return $response->json();
        }
    }

    public function getShipCost(Request $request){
        $shop_id = 4904685;
        $from_district_id = 1455; //shop located

        $parameters = [
            'service_type_id' => $request->input('shipping'),
            'insurance_value' => $request->input('insurance_value'),
            'coupon' => null,
            'to_ward_code' => $request->input('wardCode'),
            'to_district_id' => $request->input('districtId'),
            'from_district_id' => $from_district_id,
            'weight' => 1500, //gram
            'length' => 15, //cm
            'width' => 15,  //cm
            'height' => 15, //cm
        ];

        $response = Http::withHeaders([
            'token' => \Config::get('app.ghn'),
            'shop_id' => $shop_id,
        ])
            ->get('https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/fee', $parameters);
        //dd($response);
        if ($response->ok()) {
            return $response->json();
        } else {
            return $response->json();
        }
    }
}
