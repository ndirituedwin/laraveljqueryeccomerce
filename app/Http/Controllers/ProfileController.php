<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posteditrequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function geteditprofile(){
       // dd("v");
        return view('profile.getedit');
    }
    public function posteditprofile(Posteditrequest $request){
           Auth::user()->update([
               'first_name'=>$request->first_name,
               'last_name'=>$request->last_name,
           ]);
           return back()->withinfo('profile updated');
    }
}
