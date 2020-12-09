<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\History;

class HistoryController extends Controller
{
    public function index(){
        $hists = History::all();

        if(count($hists) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $hists
            ],200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ],404);
    }

    public function show($id){
        $hist = History::find($id);

        if(!is_null($motor)){
            return response([
                'message' => 'Retrieve History Success',
                'data' => $hist
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
            'id_user' => 'required',
            'id_motor' => 'required',
            'tglPinjam' => 'required',
            'tglKembali' => 'required',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $hist = History::create($storeData);
        return response([
            'message' => 'Add History Success',
            'data' => $hist,
        ],200);
    }

    public function destroy($id){
        $hist = History::find($id);

        if(is_null($hist)){
            return response([
                'message' => 'History Not Found',
                'data' => $null
            ],404);
        }

        if($hist->delete()){
            return response([
            'message' => 'Delete History Success',
            'data' => $hist,
            ],200);
        } 
        
        return response([
            'message' => 'Delete History Failed',
            'data' => null,
        ],400);
    }

    public function update(Request $request, $id){
        $hist = History::find($id);
        if(is_null($hist)){
            return response([
                'message' => 'History Not Found',
                'data' => $null
            ],404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'id_user' => 'required',
            'id_motor' => 'required',
            'tglPinjam' => 'required',
            'tglKembali' => 'required',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $motor->id_user = $updateData['id_user'];
        $motor->id_motor = $updateData['id_motor'];
        $motor->tglPinjam = $updateData['tglPinjam'];
        $motor->tglKembali = $updateData['tglKembali'];
        if($hist->save()){
            return response([
            'message' => 'Update History Success',
            'data' => $hist,
            ],200);
        } 
        
        return response([
            'message' => 'Update History Failed',
            'data' => null,
        ],400);
    }
}
