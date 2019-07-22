<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use App\userdata;
use App\doctor_room;
use Session;
use Carbon\Carbon;
use Auth;
class Usercontroller extends Controller
{
      /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
     $this->middleware('auth:api');
     // $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        return $users;
        
        return view('admin.viewusers',compact('users'));
    }
    public function getpatients(){
            $users = User::where('level' , 'member')->get();
            $responce['code'] = 200;
            $responce['patients'] = $users;
            return response()->json($responce,200); 
    }
    public function endsession(request $request){
       $this->validate($request,[
            
            "doctor_id" =>  "required",
            "room_id" =>  "required"
            
         ]);
        $doctor = User::where(['id' => $request->doctor_id , 'level' => 'Super_admin'])->get();
      $room = doctor_room::where(['user_id' =>  $request->doctor_id , 'room_id' => $request->room_id])->first();
      if(isset($doctor) ){
        if(isset($room)){
          $room->delete();
           $responce['code'] = 200;
            return response()->json($responce,200); 
        }else{
           $responce['code'] = 202;
           $responce['error'] = "Invalid Details";
          return response()->json($responce,200);
        }
      }else{
        $responce['code'] = 202;
           $responce['error'] = "Invalid Details";
          return response()->json($responce,200);
      }
    }
    public function assignroom(request $request){
      $this->validate($request,[
            
            "doctor_id" =>  "required",
            "room_id" =>  "required"
            
         ]);
      $doctor = User::where(['id' => $request->doctor_id , 'level' => 'Super_admin'])->get();
      $room = doctor_room::where('user_id' ,  $request->doctor_id)->first();
      if(isset($doctor)){
        if(isset($room)){
          $room->delete();
        }
        $new_room =  new doctor_room;
        $new_room->user_id = $request->doctor_id;
        if($request->room_id == 1){
        $new_room->room_id = $request->room_id;
        $new_room->room_name ="Consultation Room";

        }else if($request->room_id == 2){
        $new_room->room_id = $request->room_id;
        $new_room->room_name = "Sick Patients Room";

        }else if($request->room_id == 3){
        $new_room->room_id = $request->room_id;
        $new_room->room_name ="Emergency Room";

        }

        $new_room->save();
        $responce['code'] = 200;
        return response()->json($responce,200); 

      }else{
         $responce['code'] = 202;
         $responce['error'] = "Invalid doctor";
        return response()->json($responce,200); 

      }
    }
     public function getdoctors(){
            $doctors = User::where('level' , 'Super_admin')->get();
            $rooms = doctor_room::all();
            foreach ($doctors as $doctor) {
              $stat = false;
              $room_number = 0;
              foreach ($rooms as $room) {
                if($room->user_id == $doctor->id){
                  $stat = true;
                  $room_number = $room->room_id;
                }
              }
              if($stat){
                $doctor['room_number'] = $room_number;
              }else{
               $doctor['room_number'] = ''; 
              }
            }
            $responce['code'] = 200;
            $responce['doctors'] = $doctors;
            return response()->json($responce,200); 
    }
   public function getprofiles(){
    $users = User::all();
    $profiles = userdata::all();
    foreach ($profiles as $profile) {
      foreach ($users as $user) {
        if($profile->user_id == $user->id){
          $profile['user'] =  $user;
        }
      }
    }
     $responce['code'] = 200;
            $responce['profiles'] = $profiles;
            return response()->json($responce,200); 
   }
    public function createprofile(request $request){
        $this->validate($request,[
            
            "email" =>  "required",
            "date_of_birth" =>  "required",
            "blood_group" =>  "required",
            "contact" =>  "required",
            "address" =>  "required",
            "genotype" =>  "required",
            "tag_code" =>  "required"

         ]);
        $user = User::where('email', $request->email )->first();
        if(!isset($user)){
            $responce['code'] = 202;
          $responce['error'] = 'Invalid User Email';
          return response()->json($responce,200);     
        }
        $userdata = userdata::where('user_id' , $user->id)->first();
        if(isset($userdata)){
          $responce['code'] = 202;
          $responce['error'] = 'user profile already exist';
          return response()->json($responce,200);    
        }
        else{
            $data = new userdata;
            $data->user_id = $user->id;
            $data->contact = $request->contact;
            $data->genotype = $request->genotype;
            $data->blood_group = $request->blood_group;
            $data->address = $request->address;
            $data->tag_code = $request->tag_code;
            $data->date_of_birth = (new Carbon($request->date_of_birth))->format('Y-m-d H:i:s');
            $data->save();
            $responce['code'] = 200;
          $responce['message'] = 'User Profile Created successfully';
          return response()->json($responce,200);    
        }
    }
    public function upgradeuser(){
        $this->validate($request,[
            'user_id'=>'required',
            'level' => 'required'
            ]);
        $user = Auth::user();
        if(isAdmin($user) || isSuperAdmin($user)){
            $cuser = User::find($request->user_id);
            $cuser->level = $request->level;
            $cuser->save();
             $responce['code'] = 200;
          $responce['message'] = 'User Level Changed successfully';
          return response()->json($responce,200);  

        }else{
          
               $response['code'] = 202;
                $response['error'] ="Access Denied"; 
                    return response()->json($response,200);  
        }

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.register');
    }
    public function editusername(request $request){
        $this->validate($request,[
            'userName'=>'required'
            ]);
        $user_id = Auth::User()->id;
        $user = User::findorFail($user_id);
        $user->username = $request->userName;
        $user->save();
        $responce['code'] = 200;
     return response()->json($responce,200);

    }
    public function editpassword(request $request){
        // return $request->all();
        $this->validate($request,[
            'oldpassword'=>'required',
            'newpassword'=>'required'
            ]);
        $user = Auth::User();
        
          $newuser = User::findorFail($user->id);
            
        $newuser->password = bcrypt($request->newpassword);
        $newuser->save();
         $responce['code'] = 200;
          return response()->json($responce,200);
        // $user = Auth::User();
        // if(Auth::attempt(['email' => $user->email, 'password' => $request->oldpassword])){
       
        // }else{
        //      $responce['code'] = 202;
        //      $responce['error'] = "The Old password is Incorrect!!!";
        //      return response()->json($responce,200);
        // }
             
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
         $user = new User;
        $this->validate($request,[
            'email'=>'required|unique:User',
            'name'=>'required',
            'password' => 'required|min(4)'
            ]);
        $user->name = $request->name;
         $user->email = $request->email;
         $user->password = bcrypt('$request->password');

        $user->save();
        session()->flash('message','updated successfully');
        return redirect('users.create');
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
