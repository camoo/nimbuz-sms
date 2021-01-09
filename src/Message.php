<?php
declare(strict_types=1);
/**
 * CAMOO SARL: http://www.camoo.cm
 *
 * @copyright (c) camoo.cm
 * @license: You are not allowed to sell or distribute this software without permission
 * Copyright reserved
 * File: src/Message.php
 * Created by: Camoo Sarl (sms@camoo.sarl)
 * Description: CAMOO SMS LIB
 *
 * @link http://www.camoo.cm
 */

namespace Nimbuz\Sms;

use Nimbuz\Sms\Exception\NimbuzSmsException;
use Nimbuz\Sms\Lib\Utils;
use Nimbuz\Sms\Response\Message as MessageResponse;
use Nimbuz\Sms\Http\Client;

/**
 * Class Nimbuz\Sms\Message handles the methods and properties of sending a SMS message.
 */
class Message extends Base
{

    /**
     * Sends Message
     *
     * @return MessageResponse
     */
    public function send()
    {
        try {
            $this->setResourceName('sms');
            $response = $this->execRequest(Client::POST_REQUEST);
            return new MessageResponse($response);
        } catch (NimbuzSmsException $err) {
            return new MessageResponse($err->getMessage(), $err->getCode());
        }
    }

    /**
     * Grabbs DLR of a sent message with status
     *
     * @return MessageResponse
     */
    public function dlr()
    {
        try {
            $this->setResourceName(Constants::RESOURCE_STATUS);
            $response = $this->execRequest(Client::POST_REQUEST, true, Constants::RESOURCE_STATUS);
            return new MessageResponse($response);
        } catch (NimbuzSmsException $err) {
            return new MessageResponse($err->getMessage(), $err->getCode());
        }
    }

    /**
     * sends bulk message
     *
     * @return integer|bool
     */
    public function sendBulk($hCallBack=[])
    {
        $xResp = $this->execBulk($hCallBack);
        return !empty($xResp)? $xResp : false;
    }
}
