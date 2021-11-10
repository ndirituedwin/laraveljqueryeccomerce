<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cmspage;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Routing\Annotation\Route;
use Illuminate\Support\Facades\Mail;

class CmspageController extends Controller
{
    public function cmspage(){
             //  dd("Dd");
         $currenturl=url()->current();
         $currenturl=str_replace("http://127.0.0.1:8000/","",$currenturl);
        //  dd($currenturl);
          $cmspagesroute=Cmspage::where('status',1)->pluck('slug')->toArray();
          $getsections=Section::with('categories')->where('status',1)->get();
          if(in_array($currenturl, $cmspagesroute)){
              $cmspagesdetails=Cmspage::where('slug',$currenturl)->first()->toArray();
              Session::put('cmspagesdetails',$cmspagesdetails['slug']);
              return view('Frontend.Pages.cmspages')
              ->withsections($getsections)
              ->withcmspagesdetails($cmspagesdetails);
          }else{
              abort(404);
          }

    }
    public function contactus(Request $request){
           if($request->isMethod('POST')){
               $this->validate($request,[
                   'name'=>'required|string',
                   'email'=>'required|email|max:50',
                   'subject'=>'required|string|max:255',
                   'messsage'=>'required|string|max:500',
               ]);
             //  dd("ss");
               $email='edwinnderitu018@gmail.com';
               $messagedata=[
                   'name'=>$request['name'],
                   'email'=>$request['email'],
                   'subject'=>$request['subject'],
                   'messsage'=>$request['messsage'],
               ];
            // dd($messagedata['name']);
              try {
                Mail::send('Frontend.emails.customerinquiry', $messagedata, function ($message) use ($email) {
                    $message->to($email)->subject('Message to laraveleccomerce');
                });
                $message="Thanks for contacting us, we are looking forward to contacting you soon";
                Session::flash('success_message',$message);
                return redirect()->back();

              } catch (\Throwable $th) {
                  return back()->withdanger("failed".$th->getMessage());
              }

           }
             $getsections=Section::with('categories')->where('status',1)->get();
             return view('Frontend.Pages.contact-us')->withsections($getsections);
    }
}