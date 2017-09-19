<?php
namespace App;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use \GatewayWorker\Lib\Gateway;
use App\Msg\ErrorMsg;
use App\MsgIds;
use App\Msg\ToClientClass;
use App\Msg\ToGroupClass;
use App\Msg\ToAllClass;
/**
 * Description of MsgHandler
 *
 * @author Xp
 */
class MsgHandler
{
    
    public static function dispatch($client_id, $message) {
        //判断消息类型，并分发给相应的消息处理类
        $json = json_decode($message);

        if (!$json || !isset($json->id)) {
            //消息错误
            return ErrorMsg::handle($client_id, MsgIds::MSG_FORMAT_ERROR);
        }
        
        switch ($json->id) {
            case MsgIds::MESSAGE_GATEWAY_TO_ALL :
                ToAllClass::handle($client_id, $json);
                break;
            case MsgIds::MESSAGE_GATEWAY_TO_GROUP :
                if (isset($json->passback)) //不要回传，即发送过来的客户端不关心这个数据
                    ToGroupClass::handle($client_id, $json, FALSE);
                else 
                    ToGroupClass::handle($client_id, $json);
                break;
            case MsgIds::MESSAGE_GATEWAY_TO_CLIENT :
                ToClientClass::handle($client_id, $json);
                break;
            case MsgIds::MESSAGE_GATEWAY_BUSSINESS :
                break;
            default :
                //未定义的消息，不做处理
                ErrorMsg::handle($client_id, MsgIds::MSG_FORMAT_ERROR);
                break;
        }
    }
}
