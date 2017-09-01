<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Msg;

use App\Msg\MsgHandleBase;
use \GatewayWorker\Lib\Gateway;
/**
 * Description of errorMsg
 *
 * @author Xp
 */
class ErrorMsg extends MsgHandleBase
{
    static public function handle($client_id, $code) {
        
        //todo: 根据业务需要检测相关数据
        //todo: 根据业务需要修改json数据
        Gateway::sendToClient(self::output(array('code' => $code, 'msg' => '')));
    }

}
