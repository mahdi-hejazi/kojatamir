<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\ProvinceCity;
use App\Models\Repairman;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isNull;

class RepairmanController extends Controller
{
    public function addRepairmanInfo(Request $request)
    {
        $validatedData = $request->validate([
            'profile_description' => 'required|string',
            'images' => 'required|string',
            'repair_service_IDs'=> 'required|string'
            ]);
         $validatedData['images']=explode(',',  $validatedData['images']);
         $validatedData['repair_service_IDs']=explode(',',  $validatedData['repair_service_IDs']);

        $request->user()->repairman()->delete();
        $repairma=$request->user()->repairman()->create([
            'images' =>  json_encode($validatedData['images']),
            'profile_description' => $validatedData['profile_description'],
        ]);
        foreach ($validatedData['repair_service_IDs'] as $service_id){
            $repairma->repairServices()->attach($service_id);
        }

        return response()->json([
            'status' => 'done',
            'message' => 'repairman info add to user',
        ]);
    }
    public function addLicence(Request $request){
        $validatedData = $request->validate([
            'image' => 'required|string',
            'description' => 'required|string',
        ]);
//        $request->user()->repairman()->businessLicenses()->create([
//            'image' => $validatedData['image'],
//            'description' => $validatedData['description'],
//        ]);
        return response()->json([
            'status' => 'done',
            'message' => 'business licence info add to user',
        ]);
    }
    public function getRepairmanInfo(Request $request){
        return $request->user()->repairman()
            ->with('repairServices')
            ->with('user')
            ->with('user.addresses')
            ->with('user.addresses.city')
            ->with('user.addresses.city.province')
           ->get() ;
    }
    public function index()
    {
        $repair_service_name=null;
        $city_id=null;
        $repairmen=Repairman::with('repairServices')
            ->with('user')
            ->with('user.addresses')
            ->with('user.addresses.city')
            ->with('user.addresses.city.province');

        if ( !isNull($repair_service_name))
            $repairmen=$repairmen->where('repairServices.name', 'like', '%'.$repair_service_name.'%');
        //todo make search for child too
        if ( !isNull($city_id))
            $repairmen=$repairmen->where('user.addresses.city.id', '=', $city_id)->orWhere('user.addresses.city.province.id', '=', $city_id);
        //todo make search for child too

        //we just search for parent


        $repairmen=$repairmen->get();
        return \response()->json([$repairmen]);

    }
}
