<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends Controller
{
   //Show Settings
   public function ShowSettings(){
       $settings=Setting::first();
       return view('Settings.Setting',compact('settings'));
   }

   //Update Settings
   public function UpdateSetting(Request $req){
       try{
        if($req->register == 'on'){
            Setting::where('id',1)->update([
                'register' => 1
            ]);
        }
        else{
            Setting::where('id',1)->update([
                'register' => 0
            ]);
        }

        if($req->order == 'on'){
            Setting::where('id',1)->update([
                'order' => 1
            ]);
        }
        else{
            Setting::where('id',1)->update([
                'order' => 0
            ]);
        }
        return back()->with('status',"Settings changed !!");
       }
       catch(\Illuminate\Database\QueryException $ex){
        return redirect('/error')->with('error', $ex->getMessage());
       }
   }
}
