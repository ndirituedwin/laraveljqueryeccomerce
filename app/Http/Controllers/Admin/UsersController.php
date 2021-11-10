<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    public function users(){
        Session::put('page','users');
        $users=User::all();
        // dd($users);
        return view('admin.users.users')->withusers($users);
    }
    public function updateuserstatus(Request $request){
        if ($request->ajax()) {
            //  echo"<prev>";print_r($request->status);die;
            if ($request->status=="Active") {
                $status=0;
            } else {
                $status=1;
            }
            User::where('id', $request->user_id)->update(['status'=>$status]);
            return response()->json(['status'=>$status,'user_id'=>$request['user_id']]);
        }
    }
}