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
}
