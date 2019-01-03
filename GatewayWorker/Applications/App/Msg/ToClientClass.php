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
 * Description of ToClientClass
 * 发送给某客户端的消息
 *
 * @author Xp
 */
class ToClientClass extends MsgHandleBase
{

    static public function handle($client_id, $json, $passback = true)
    {
        //todo: 根据业务需要检测相关数据
        //todo: 根据业务需要修改json数据
        if(isset($json->stype) && $json->stype=='firstLogin'){//首次登录发送请求
            $nofity_client = $json->notify_fd;
            Gateway::sendToClient($nofity_client,self::output($json));
        }else{
            Gateway::sendToGroup('SubNotify', self::output($json));
        }
    }

}
