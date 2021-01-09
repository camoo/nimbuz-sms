<?php
declare(strict_types=1);
namespace Nimbuz\Sms\Console;

use Nimbuz\Sms\Exception\NimbuzSmsException;

class Runner
{
    public function run($argv)
    {
        if (isset($argv)) {
            $sPASS = $argv[1];
            if ($asPASS = \Nimbuz\Sms\Lib\Utils::decodeJson(base64_decode($sPASS), true)) {
                $hCallBack = $asPASS[0];
                $sTmpName  = $asPASS[1];
                $hCredentials = $asPASS[2];
                $sFile = \Nimbuz\Sms\Constants::getSMSPath(). 'tmp/' .$sTmpName;
                if (file_exists($sFile) && is_readable($sFile)) {
                    if (($sData = file_get_contents($sFile)) && ($hData = \Nimbuz\Sms\Lib\Utils::decodeJson($sData, true))) {
                        unlink($sFile);
                        \Nimbuz\Sms\Lib\Utils::doBulkSms($hData, $hCredentials, $hCallBack);
                    }
                }
            }
        }
    }
}
