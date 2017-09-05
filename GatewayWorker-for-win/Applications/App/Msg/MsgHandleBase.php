<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Msg;


/**
 * Description of MsgHandleBase
 *
 * @author Xp
 */
abstract class MsgHandleBase
{
    static function handle($client_id, $json){}
    
    //消息格式组装
    static public function output($json) {
        if (!is_string($json)) {
            $json = json_encode($json);
        }
        return "$json\r\n";
    }
}
