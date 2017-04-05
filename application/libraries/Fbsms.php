<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fbsms
{

    var $CI;
    private $sms_activation = true;

    function __construct()
    {
        $this->CI = & get_instance();
        $tk_config = parse_ini_file(APPPATH . "config/FB.ini");
        $this->sms_activation = $tk_config['sms_activate'];
    }

    public function sendSms($smsMap)
    {
        if ($this->sms_activation) {
            $this->sendMvaayooSms($smsMap);
        }
    }

    public function sendMvaayooSms($smsMap)
    {
        $ch = curl_init();
        $user = "kshamta@saanvad.com:Saanvad";
        $senderID = "FRTBZR";
        $map = array();
        $map['user'] = $user;
        $map['senderID'] = $senderID;
        $map['receipientno'] = $smsMap['mobile'];
        $map['msgtxt'] = $smsMap['message'];
        $postdata = http_build_query($map);
        curl_setopt($ch, CURLOPT_URL, "http://api.mVaayoo.com/mvaayooapi/MessageCompose");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        $buffer = curl_exec($ch);
        if (empty($buffer)) {
            return false;
        } else {
            return true;
        }
        curl_close($ch);
    }

}
