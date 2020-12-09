<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Validator;
use App\Motor;

class MotorController extends Controller
{
    public function index(){
        $motors = Motor::all();

        if(count($motors) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $motors
            ],200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ],404);
    }

    public function show($id){
        $motor = Motor::find($id);

        if(!is_null($motor)){
            return response([
                'message' => 'Retrieve Motor Success',
                'data' => $motor
            ],200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ],404);
    }

    public function store(Request $request){
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'merk' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
            'warna' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
            'plat' => 'required|alpha_num',
            'tahun' => 'required|numeric',
            'status' => 'required|alpha',
            'harga' => 'required|numeric',
            'imgURL'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        if($storeData['imgURL'] != "-")
        {
            $image = $storeData['imgURL'];
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = Str::random(10).'.'.'png';

            Storage::disk('public')->put($imageName, base64_decode($image));

            $storeData->imgURL = $imageName;
        }

        $motor = Motor::create($storeData);
        return response([
            'message' => 'Add Motor Success',
            'data' => $motor,
        ],200);
    }

    public function destroy($id){
        $motor = Motor::find($id);

        if(is_null($motor)){
            return response([
                'message' => 'Motor Not Found',
                'data' => $null
            ],404);
        }

        if($motor->delete()){
            return response([
            'message' => 'Delete Motor Success',
            'data' => $motor,
            ],200);
        } 
        
        return response([
            'message' => 'Delete Motor Failed',
            'data' => null,
        ],400);
    }

    public function update(Request $request, $id){
        $motor = Motor::find($id);
        if(is_null($motor)){
            return response([
                'message' => 'Motor Not Found',
                'data' => $null
            ],404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'merk' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
            'warna' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
            'plat' => 'required|alpha_num',
            'tahun' => 'required|numeric',
            'status' => 'required|alpha',
            'harga' => 'required|numeric',
            'imgURL'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $motor->merk = $updateData['merk'];
        $motor->warna = $updateData['warna'];
        $motor->plat = $updateData['plat'];
        $motor->tahun = $updateData['tahun'];
        $motor->status = $updateData['status'];
        $motor->harga = $updateData['harga'];
        $motor->imgURL = $updateData['imgURL'];
        
        $image = $updateData['imgURL'];
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = Str::random(10).'.'.'png';

        Storage::disk('public')->put($imageName, base64_decode($image));

        $motor->imgURL = $imageName;

        if($motor->save()){
            return response([
            'message' => 'Update Motor Success',
            'data' => $motor,
            ],200);
        } 
        
        return response([
            'message' => 'Update Motor Failed',
            'data' => null,
        ],400);
    }
}
