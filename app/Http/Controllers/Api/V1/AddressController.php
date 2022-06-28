<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\ProvinceCity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AddressController extends Controller
{
    public function getProvincesIR(){
        return Response::json(ProvinceCity::where('parent_id',0)->get()->toArray());
    }
    public function getProvince(ProvinceCity $province){
        return Response::json($province);

    }
    public function getProvinceCities(ProvinceCity $province){
        return Response::json(ProvinceCity::where('parent_id',$province->parent_id)->get()->toArray());
    }


    public function addAddressToUser(Request $request)
    {
        $validatedData = $request->validate([
            'city_id' => 'required|integer|exists:province_cities,id',
            'address' => 'required|string',
            'postal_code' => 'max:50']);
        $request->user()->addresses()->create([
            'province_city_id'=>$validatedData['city_id'],
            'address'=>$validatedData['address'],
            'postal_code'=>$validatedData['postal_code'],

        ]);
        return response()->json([
            'status' => 'done',
            'message' => 'address add to user',
        ]);
    }
    public function getAddresses(Request $request)
    {
        return response()->json(
            $request->user()->addresses()->get()
        );
    }

}
