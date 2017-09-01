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
class ToGroupClass extends MsgHandleBase
{
    static public function handle($client_id, $json) {
        
        //todo: 根据业务需要检测相关数据
        //todo: 根据业务需要修改json数据
        Gateway::sendToAll(self::output($json));
    }
}
