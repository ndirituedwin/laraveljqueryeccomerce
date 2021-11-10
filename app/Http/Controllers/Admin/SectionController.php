<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SectionController extends Controller
{
    public function getsections(){
        Session::put('page','sections');
        $sections=Section::all();
        return view('admin.sections.getsections')->withsections($sections);
    }
    public function updatesectionstatus(Request $request){
        if($request->ajax()){
            //  echo"<prev>";print_r($request->status);die;
              if($request->status=="Active"){
                  $status=0;
              }else{
                  $status=1;
              }
              Section::where('id',$request->section_id)->update(['status'=>$status]);
              return response()->json(['status'=>$status,'section_id'=>$request['section_id']]);

          }
}
}