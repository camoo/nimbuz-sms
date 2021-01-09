<?php
declare(strict_types=1);
namespace Nimbuz\Sms;

/**
 * CAMOO SARL: http://www.camoo.cm
 * @copyright (c) camoo.cm
 * @license: You are not allowed to sell or distribute this software without permission
 * Copyright reserved
 * File: src/Balance.php
 * Created by: Camoo Sarl (sms@camoo.sarl)
 * Description: CAMOO SMS LIB
 *
 * @link http://www.camoo.cm
 */

/**
 * Class Nimbuz\Sms\Balance
 *
 * Get or add balance to your account
 */
use Nimbuz\Sms\Exception\NimbuzSmsException;
use Nimbuz\Sms\Response\Balance as BalanceResponse;
use Nimbuz\Sms\Http\Client;

class Balance extends Base
{

    /**
    * read the current user balance
    *
    * @throws Exception\NimbuzSmsException
    * @return mixed Balance
    */
    public function get()
    {
        try {
            $this->setResourceName(Constants::RESOURCE_BALANCE);
            $response = $this->execRequest(Client::GET_REQUEST, false);
            return new BalanceResponse($response);
        } catch (NimbuzSmsException $err) {
            return new BalanceResponse($err->getMessage(), $err->getCode());
        }
    }
}
