<?php

namespace App\Helpers;

use Mail;
use Mailgun\Mailgun;

class Common {
    
    public static function soundwaveCronEmail($dataEmail){
        $auth_token = "abcdef";
        //$mgClient = new Mailgun($auth_token);
        $mgClient = Mailgun::create($auth_token);
    
        $domain = "abc.com";
        $result = $mgClient->messages()->send($domain, $dataEmail);
        //if($result->http_response_code === 200)
    
        return $result;
      }
}
?>