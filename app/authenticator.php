<?php

namespace App;

use App\usersecret;
use App\authkey;

class authenticator 
{
    //
      public function authenticate($data){

    $secret = usersecret::where('secret', $data->secret)->first();
    $token  = authkey::where('auth_token',$data->token)->first();

    if (count($secret) > 0 && count($token) > 0) {
        if ($secret->user_id == $token->user_id){
            return 1;
        }
        else {
            return 0;
        }
    }
    else {
        return 0;
    }
   }

}
