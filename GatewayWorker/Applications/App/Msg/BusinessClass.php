<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Msg;

use \GatewayWorker\Lib\Gateway;
use App\Msg\MsgHandleBase;
use App\Msg\ErrorMsg;

/**
 * Description of ToAllClass
 *
 * @author Xp
 */
class BusinessClass extends MsgHandleBase {

    static public function handle($client_id, $json, $passback = true) {
        //加入组
        if ($json->business_type == 'JoinGroup' && isset($json->group) && !empty($json->group)) {
            Gateway::joinGroup($client_id, $json->group);
            Gateway::sendToClient($client_id, 'join success');
        } else if ($json->business_type == 'firstLogin' && isset($json->client) && !empty($json->client)){
            //某用户第一次连接，需要获取一次实时信息给他
            Gateway::sendToGroup('TaskServer', self::output($json));
        }
    }

}
