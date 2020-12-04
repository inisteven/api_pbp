<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Validator;
use App\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(){
        $users = User::all();

        if(count($users) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $users
            ],200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ],404);
    }

    public function show($id){
        $user = User::find($id);

        if(!is_null($user)){
            return response([
                'message' => 'Retrieve User Success',
                'data' => $user
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
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => 'required|alpha_num',
            'phone' => 'required|alpha_num',
            'ktp' => 'required|alpha_num',
            'imgURL'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $user = User::create($storeData);
        return response([
            'message' => 'Add User Success',
            'data' => $user,
        ],200);
    }

    public function destroy($id){
        $user = User::find($id);

        if(is_null($user)){
            return response([
                'message' => 'User Not Found',
                'data' => $null
            ],404);
        }

        if($user->delete()){
            return response([
            'message' => 'Delete User Success',
            'data' => $user,
            ],200);
        } 
        
        return response([
            'message' => 'Delete User Failed',
            'data' => null,
        ],400);
    }

    public function update(Request $request, $id){
        $user = User::find($id);
        if(is_null($user)){
            return response([
                'message' => 'User Not Found',
                'data' => $null
            ],404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'name' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => 'required|alpha_num',
            'phone' => 'required|alpha_num',
            'ktp' => 'required|alpha_num',
            'imgURL' => 'alpha_num'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $user->name = $updateData['name'];
        $user->email = $updateData['email'];
        $user->password = $updateData['password'];
        $user->phone = $updateData['phone'];
        $user->ktp = $updateData['ktp'];
        $user->imgURL = $updateData['imgURL'];

        if($user->save()){
            return response([
            'message' => 'Update User Success',
            'data' => $user,
            ],200);
        } 
        
        return response([
            'message' => 'Update User Failed',
            'data' => null,
        ],400);
    }

    public function find($id){
        $user = DB::table('users')->where('email', $id)->first();

        if(!is_null($user)){
            return response([
                'message' => 'Retrieve User Success',
                'data' => $user
            ],200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ],404);
    }
}
