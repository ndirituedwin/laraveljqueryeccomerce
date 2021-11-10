<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use App\Models\AdminsRole;

class RolesController extends Controller
{
    public function getadmins(){
        if(Auth::guard('admin')->user()->type=="superadmin" || Auth::guard('admin')->user()->type=="admin"){
            Session::put('page', 'roles');
        $admins=Admin::all();
        return view('admin.Roles.roles')->withadmins($admins);
    } else{
            return redirect()->route('dashboard');
        }
    }
    public function addeditsubadmin(Request $request,$id=null){
        if($id==""){
            // $this->validate($request,[
            //     'name'=>'required|string',
            //     'type'=>'required|string',
            //     'mobile'=>'required|string',
            //     'email'=>'required|email|string',
            //     'password'=>'required|string|min:6',
            // ]);
            // dd($request->all());
            $title="Add sub admin";
            $admindata=new Admin();
            $message="Admin/subadmin added";
        }else{
       //update
        $title="Update sub admin";
        $admindata= Admin::find($id);
        // dd($admindata);
        $message="Admin/subadmin Updated";

        }
       if ($request->isMethod('POST')) {
           if($id==""){
               $this->validate($request,[
                   'email'=>'required|email|unique:admins',
                 'name'=>'required|string',
                'type'=>'required|string',
                'mobile'=>'required|string',
                'password'=>'required|string|min:6',
               ]);
           }else{
            $this->validate($request,[
                // 'email'=>'required|email',
              'name'=>'required|string',
             'type'=>'required|string',
             'mobile'=>'required|string',
            //  'password'=>'required|string|min:6',
            ]);
           }
        if($request->hasFile('image')){
            $filenameext=$request->file('image')->getClientOriginalName();
             $filename=pathinfo($filenameext,PATHINFO_FILENAME);

               $filenameext=$request->file('image')->getClientOriginalExtension();
               $filenametostore=$filename.'.'.time().'.'.$filenameext;
               $path=$request->file('image')->storeAs('public/adminlte/adminimages/images/profile',$filenametostore);
             //dd($path);
            //    Admin::where('email',Auth::guard('admin')->user()->update(['image'=>$filenametostore]));
             $admindata->image=$filenametostore;
               // dd("s");
            }
            $admindata->name=$request['name'];
            $admindata->mobile=$request['mobile'];
            if($id==""){
                $admindata->email=$request['email'];
                $admindata->type=$request['type'];
                $admindata->status=1;
            }
            if($request['password']!=""){
                $admindata['password']=bcrypt($request['password']);
            }
            $admindata->save();
            Session::flash('success_message',$message);
            return redirect()->route('roles.render');

       }




        return view('admin.Roles.addeditsubadmin')->withtitle($title)->withadmindata($admindata);
    }
    public function updateadminstatus(Request $request){
        if ($request->ajax()) {
            //  echo"<prev>";print_r($request->status);die;
            if ($request->status=="Active") {
                $status=0;
            } else {
                $status=1;
            }
            if (Auth::guard('admin')->user()->id !=$request->admin_id && Auth::guard('admin')->user()->type=="superadmin"){
                Admin::where('id', $request->admin_id)->update(['status'=>$status]);
                return response()->json(['status'=>$status,'admin_id'=>$request['admin_id']]);
            }
        }
    }
    public function deleteadmin($id){
       try {
        if(Auth::guard('admin')->user()->id !=$id && Auth::guard('admin')->user()->type=="superadmin"){
            Admin::where('id',$id)->delete();
            return back()->withsuccess('admin deleted');
           }else{
               return back()->withdanger("Permissions denied");
           }
       } catch (\Throwable $th) {
           return back()->withdanger("failed ".$th->getMessage());
       }

   }
   public function updateadminroles(Request $request,$id){
       if ($request->isMethod('POST')) {
           $data=$request->all();
        //    dd($data);
           unset($data['_token']);
        AdminsRole::where('admin_id',$id)->delete();
           foreach ($data as $key => $value) {
               if (isset($value['view'])) {
                   $view=$value['view'];
               }else{
                   $view=0;
               }
               if (isset($value['edit'])) {
                $edit=$value['edit'];
            }else{
                $edit=0;
            }
            if (isset($value['full'])) {
                $full=$value['full'];
            }else{
                $full=0;
            }
            AdminsRole::where('admin_id',$id)->insert([
                'admin_id'=>$id,
                'module'=>$key,
                'view_access'=>$view,
                'edit_access'=>$edit,
                'full_access'=>$full
            ]);
            return back()->withsuccess("Role updated successfully");
           }

       }

    $admindetails=Admin::where('id',$id)->first()->toArray();
    $adminroles=AdminsRole::where('admin_id',$id)->get()->toArray();
    // dd($adminroles);
    $title="Update ". $admindetails['name']." (".($admindetails['type']).") roles and permissions";

       return view('admin.Roles.updaterolesandpermissions')
       ->withadminroles($adminroles)
       ->withadmindetails($admindetails)
       ->withtitle($title);

  }
}