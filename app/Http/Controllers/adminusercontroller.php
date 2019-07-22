<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\registeredproduct;
use App\shareddevice;
use Auth;
use Validator;

class adminusercontroller extends Controller
{
         public function __construct()
    {
        $this->middleware('auth:api');
       

    }
    public function index(){

    
     $user = Auth::user();
     $users = User::where('level' , 'member')->orderBy('created_at', 'dec')->get();
        $admins = User::where('level' , 'Admin')->orderBy('created_at', 'dec')->get();
        $alluser = User::all();
        $superadmins = User::where('level' , 'Super_admin')->orderBy('created_at', 'dec')->get();
       if($this->isAdmin($user)){
        $allusers = $alluser = User::all();
       $responce['users' ] = $users;
        $responce['allusers' ] = $allusers;
        $responce['admins' ] = $admins;
       $responce['superadmins' ] = $superadmins;
        $responce['code' ] = 200;
         return response()->json($responce,200);

       }
        else{
           
             $responce['code' ] = 202;
             $responce['error' ] =  "Access Denied"; 
         return response()->json($responce,200);
 
        }	
    }
      public function getuserdata(request $request){
      	$this->validate($request,[     
             'user_id' => 'required'
       ]);
    
     $user = Auth::user();
        if($this->isAdmin($user)){
        $person = User::findOrfail($request->user_id);
        $devices = registeredproduct::where('email'  , $person->email)->orderBy('created_at', 'dec')->get();
        $shareddevices = shareddevice::where('sharedto_id'  , $person->id)->orderBy('created_at', 'dec')->get();

        $responce['user'] = $person;
        $responce['devices'] = $devices;
        $responce['shareddevices'] = $shareddevices;

        $responce['code' ] = 200;
         return response()->json($responce,200);

        }else{
             $responce['code' ] = 202;
             $responce['error' ] =  "Access Denied"; 
         return response()->json($responce,200);    
        }	
    }


    public function default(){
    	$this->validate($request,[     
             'product_id' => 'required',
             'port_number' => 'required',
             'product_name' => 'required',
    ]);
    $user = Auth::user();
        if($this->isAdmin($user)){

        }else{
           return "Access Denied";    
        }
}
public function saveuser(request $request){
    $validator = Validator::make($request->all(), [
             "username" =>  "required",
             'email' => 'required|string|email|max:255',
             'level' => 'required',
             'id' => ''
       ]);
        
       if ($validator->fails()) {
          
            return $validator->messages();
       }
       else {
        $user = User::findOrfail($request->id);
    $user->level = $request->level;

    $user->username = $request->username;
    $user->email = $request->email;
    $user->save();

  
    $response['code'] = 200;
    $response['user'] = $user;
    return response()->json($response ,200);
       }

}
    public function isAdmin($user){
    	if ($user->level == 'Admin' || $user->level == 'Super_admin'){
    		return true;
    	}
    	else{
    		return false;

    	}
    }
    public function isSuperAdmin($user){
    	if($user->level == 'Super_admin'){
    		return true;

    	}
    	else{
    		return false;
    	}
    }
}
