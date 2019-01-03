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
        } else if ($json->business_type == 'firstLogin' && !empty($json->client) && !empty($json->catalog_id)){
            $json->notify_client = $client_id;
            //某用户第一次连接，需要获取一次实时信息给他
            Gateway::sendToGroup('TaskServer_'.$json->catalog_id, self::output($json));
        }
    }

}
