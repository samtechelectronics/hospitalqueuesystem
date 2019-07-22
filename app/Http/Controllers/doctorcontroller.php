<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\doctor_room;
use App\queue;
use App\userdata;
use App\medical_history;
use Auth;
class doctorcontroller extends Controller
{
       public function __construct()
    {
     $this->middleware('auth:api');
     // $this->middleware('admin');
    }
    public function getdata(request $request){
    	$this->validate($request,[
            
            "doctor_id" =>  "required"
         ]);
    	$doctor = User::where(['id' => $request->doctor_id , 'level' => 'Super_admin'])->first();
    	if(isset($doctor)){

    		$doctor_room = doctor_room::where( 'user_id', $request->doctor_id)->first();
    		if(isset($doctor_room)){
    			$queuelist =  queue::where(['status' => 'pending' , 'emergency_level' => $doctor_room->room_id])->get();
    			if(count($queuelist) > 0){
                    $queue_number = count($queuelist);
                $responce['queue_number'] = $queue_number;
                $responce['roomdetails'] = $doctor_room;
                $responce['roomdetails']['doctor'] = $doctor;
                $i = 0;
                foreach ($queuelist as $queue) {
                $i++;
                if($i == 1){
                    $responce['current_patient'] = $queue;

                }   
                else if($i == 2){
                    $responce['next_patient'] = $queue;

                }else{
                    break;
                }
                }
                $responce['current_patient']['profile'] = User::find($responce['current_patient']->user_id);
                $responce['current_patient']['data'] = userdata::where('user_id' , $responce['current_patient']->user_id)->first();
                if($queue_number > 1){
                    $responce['next_patient']['profile'] = User::find($responce['next_patient']->user_id);
                $responce['next_patient']['data'] = userdata::where('user_id' , $responce['next_patient']->user_id)->first();
                }
                
                 $responce['code'] = 200;
                 $responce['queue'] = true;

                 return response()->json($responce,200);
             }else{
                 $responce['code'] = 200;
                 $responce['queue'] = false;
                 return response()->json($responce,200);
             }
    		}else{
    			$responce['code'] = 202;
    		$responce['error'] = 'Not Assigned to any room';
    	 	return response()->json($responce,200);
    		}
    	}
    	else{
    		$responce['code'] = 500;
    		$responce['error'] = 'Not a doctor';
    	 	return response()->json($responce,500);
    	}

    }
    public function getqueue(request $request){
    $this->validate($request,[
            
            "doctor_id" =>  "required"
         ]);
    	$doctor = User::where(['id' => $request->doctor_id , 'level' => 'Super_admin'])->orWhere(['id' => $request->doctor_id , 'level' => 'Admin'])->first();
    	if(isset($doctor)){

    		$doctor_room = doctor_room::where( 'user_id', $request->doctor_id)->first();
    		if(isset($doctor_room)){
    			$queuelist =  queue::where(['status' => 'pending' , 'emergency_level' => $doctor_room->room_id])->get();
                $users = User::all();
                foreach ($queuelist as $queue) {
                    foreach ($users as $user) {
                        if($queue->user_id == $user->id){
                            $queue['user_name'] = $user->username;
                        }
                    }
                }
    			$responce['code'] = 200;
    		$responce['queue'] = $queuelist;
    	 	return response()->json($responce,200);
    		}else{
    			$responce['code'] = 202;
    		$responce['error'] = 'Not Assigned to any room';
    	 	return response()->json($responce,200);
    		}
    	}
    	else{
    		$responce['code'] = 500;
    		$responce['error'] = 'Not a doctor';
    	 	return response()->json($responce,500);
    	}
	
    }
    public function savedata(request $request){
    	  $this->validate($request,[
            "doctor_id" =>  "required",
            "user_id" =>  "required",
            "queue_id" =>  "required",
            "note" => "required",
            "prescription" => "required"

         ]);
    	  $doctor = User::where(['id' => $request->doctor_id , 'level' => 'Super_admin'])->first();
    	if(isset($doctor)){
    		$queue = queue::findorFail($request->queue_id);
    		$queue->status = 'completed';
    		$queue->save();
    		$history = new medical_history;
    		$history->user_id = $request->user_id;
    		$history->doc_id = $request->doctor_id;
    		$history->note = $request->note;
    		$history->prescription = $request->prescription;
    		$history->save();
    		$responce['code'] = 200;
    		$responce['message'] = 'Data Saved Successfully';
    	 	return response()->json($responce,200);
 
    	}else{
    		$responce['code'] = 500;
    		$responce['error'] = 'Not a doctor';
    	 	return response()->json($responce,500);
    	}

    }
    public function getmedicalhistory(){
        $user = Auth::user();
        $history =  medical_history::where('user_id' , $user->id)->get();
            $doctors = User::where('level', 'Super_admin')->get();
            foreach ($history as $medhis) {
                foreach ($doctors as $doc) {
                    if($medhis->doc_id == $doc->id){
                        $medhis['doctor_name'] = $doc->username;

                    }               }
            }
           
            $responce['user'] = $user;
            $responce['history'] = $history;
            $responce['code'] = 200;
            return response()->json($responce,200);
 
        
    }
    public function medicalhistory(request $request){
    	$this->validate($request,[
            "doctor_id" =>  "required",
            "user_id" =>  "required"

         ]);
    	 $doctor = User::where(['id' => $request->doctor_id , 'level' => 'Super_admin'])->first();
    	if(isset($doctor)){
    		$history =  medical_history::where('user_id' , $request->user_id)->get();
    		$doctors = User::where('level', 'Super_admin')->get();
    		foreach ($history as $medhis) {
    			foreach ($doctors as $doc) {
    				if($medhis->doc_id == $doc->id){
    					$medhis['doctor_name'] = $doc->username;

    				}    			}
    		}
    		$patient = User::find($request->user_id);
    		$responce['user'] = $patient;
    		$responce['history'] = $history;
    		$responce['code'] = 200;
    	 	return response()->json($responce,200);
 
    	}else{
    		$responce['code'] = 500;
    		$responce['error'] = 'Not a doctor';
    	 	return response()->json($responce,500);
    	}
    }
    public function getmedicalreport(request $request){
    	$this->validate($request,[
            "doctor_id" =>  "required",
            "med_id" =>  "required"

         ]);
    	 $doctor = User::where(['id' => $request->doctor_id , 'level' => 'Super_admin'])->first();
    	if(isset($doctor)){
    		$history = medical_history::find($request->med_id);
    		$userdata = userdata::where('user_id' , $history->user_id)->first(); 
            $patient = User::find($userdata->user_id);
            $userdata['username'] = $patient->username;
    		$responce['userdata'] = $userdata;
    		$responce['report'] = $history;
    		$responce['code'] = 200;
    	 	return response()->json($responce,200);
 
    	}else{
    		$responce['code'] = 500;
    		$responce['error'] = 'Not a doctor';
    	 	return response()->json($responce,500);
    	}
    }
}
