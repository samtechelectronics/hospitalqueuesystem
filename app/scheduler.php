<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DateTime;
use App\registeredproduct;
class scheduler 
{
    //
    public function validateinput(request $request){

       $raw_date = explode(' ',$request->Executetime);
      
      $date['date1'] = $raw_date[0];
      $date['time1'] = $raw_date[1];
      
        $date1 = $date['date1'];
        $time1 =  $date['time1'];
    $datestamp1 = strtotime($date1);
    $timestamp1 = strtotime($time1);
    $date = date('Y-m-d H:i:s', time());
       $current_date = explode(' ',$date);
       $todaydate = $current_date[0];
       $todaytime = $current_date[1];
        $todaydatestamp = strtotime($todaydate);
    $todaytimestamp = strtotime($todaytime);
    if($todaydatestamp <= $datestamp1  )  {

    
    if ($todaydatestamp == $datestamp1) {

      if($todaytimestamp < $timestamp1){
        
              return 1;

          
      }
      else{
        return 0;
      }
    }
    else{

      return 1;
          //      if($datestamp2 > $datestamp1){
          //  return 1;

          // }
          // else if($datestamp2 < $datestamp1){
          //  return 0;
          // }
          // else if($datestamp2 == $datestamp1){
          //  if($timestamp2 > $timestamp1){
          //    return 1;
          //  }
          //  else{
          //    return 0;
          //  }
          // }

  
    }
  }


  else{
    return 0;
  }
  }
    public function deactivatedevices(){
      // $date = new DateTime( '2009-10-05 18:11:13' );
      $date2 = new DateTime( date('Y-m-d H:i:s', time()) );
      $devices =  registeredproduct::all();
      foreach ($devices as $device ) {
        $date = new DateTime( $device->updated_at);

       $diffInSeconds = $date2->getTimestamp() - $date->getTimestamp();
      if($diffInSeconds > 10 ){
        $device->online = '0';
        $device->save();
      }else{
        

      } 
      }
     return 'done';
      }
       public function deactivatedevice($product_id){
      // $date = new DateTime( '2009-10-05 18:11:13' );
      $date2 = new DateTime( date('Y-m-d H:i:s', time()) );
      $device =  registeredproduct::where('product_id', $product_id)->first();
     
       if(isset($device)){
         $date = new DateTime( $device->updated_at);

       $diffInSeconds = $date2->getTimestamp() - $date->getTimestamp();
      if($diffInSeconds > 10){
        $device->online = '0';
        $device->save();
      }else{
        

      } 
    
       }
     return 'done';
      }
     
  
    public function getdatedifference($requestdate1 , $requestdate2){

        $raw_date = explode(' ',$requestdate1);
      $raw_date1 = explode(' ',$requestdate2);
      $date['date1'] = $raw_date[0];
      $date['time1'] = $raw_date[1];
      $date['date2'] = $raw_date1[0];
      $date['time2'] = $raw_date1[1];
      $date1 = $date['date1'];
        $date2 =  $date['date2'];
        $time1 =  $date['time1'];
        $time2 =  $date['time2'];

      $date1=date_create($date1);
    $date2=date_create($date2);
    $diff=date_diff($date2,$date1);

       // $datetime1 = new DateTime($time1);
       // $datetime2 = new DateTime($time2);
       // $interval = $datetime1->diff($datetime2);
    $time1 = strtotime("1980-01-01 $time1");
        $time2 = strtotime("1980-01-01 $time2");

    if ($time2 < $time1) {
        $time2 += 86400;
    }

     $timediff =  date("H:i:s", strtotime("1980-01-01 00:00:00") + ($time2 - $time1));
     $datediff = $diff->format("%R%a days");
     $time = explode(':',$timediff);

    return $datediff.' '.$time[0].' Hr '.$time[1].' min '.$time[2].' sec ';
    }



   public function runschedules( $user_id){

      $actives = schedule::where(['user_id' => $user_id , 'status' => 'pending'])->get();
      $this->activateschedules($actives);
      $deactives = schedule::where(['user_id' => $user_id , 'status' => 'active'])->get();
      $this->deactivateschedules($deactives);


      return 1;
    }
    public function activateschedules($schedules){
     $todaysdate = date('Y-m-d H:i:s', time());
      // return $timezone = date_default_timezone_get(); 
       foreach ($schedules as $schedule) {
        $Executetime = $schedule->Executetime;
      

         $device_id = $schedule->device_id;
         $port_id = $schedule->port_id;
            
         $port = productstatus::where([ 'product_id' => $device_id , 'id' => $port_id])->first();

         $datetime1 = new DateTime($todaysdate);
         $datetime2 = new DateTime($Executetime);
        
        if($datetime1 > $datetime2){
         
       if(isset($port)){
                    if($schedule->action == 'on' || $schedule->action == 'ON'){
                      if($port->state == '0'){
                        if($port->previous_value == $port->new_value){
                          if($port->new_value == '0'){
                            $port->new_value = '1';
                             $port->save();
                          }else{
                            $port->new_value = '0';
                            $port->save();
                          }
                        }
                      }
                    }elseif($schedule->action == 'OFF' || $schedule->action == 'off'){
                    if($port->state == '1'){
                        if($port->previous_value == $port->new_value){
                          if($port->new_value == '0'){
                            $port->new_value = '1';
                             $port->save();
                          }else{
                            $port->new_value = '0';
                            $port->save();
                          }
                        }
                      }
                    }

                    

                    $schedule->status = 'Executed';
                  $schedule->save();
                   $log = new devicehistory;
                       $log->user_id = '23';
                       $log->action = "schedule Executed"; 
                       $log->source = "System";
                       $log->device_id = $schedule->device_id;
                       $log->port_id = $schedule->port_id;
                       $log->save();
                  }



          
        }
       
        }
        return 'done';

        
       
    }
 


  public function isgreater($term1, $term2){

   $term1 = strtotime($term1);
   $term2 = strtotime($term2);
      if($term1>$term2){
        return 1;

      }else{
        return 0;
      }
    } 
       public function isgreaterthanorequal($term1, $term2){
        $term1 = strtotime($term1);
        $term2 = strtotime($term2);
      if($term1>=$term2){
        return 1;

      }else{
        return 0;
      }
    }
        public function isequalto($term1, $term2){
          $term1 = strtotime($term1);
          $term2 = strtotime($term2);
        if($term1 ==$term2){
        return 1;

      }else{
        return 0;
      }
    }

}
