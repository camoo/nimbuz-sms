<?php
declare(strict_types=1);

namespace Nimbuz\Sms;

/**
 * Class Constants
 *
 */
class Constants
{
    const CLIENT_VERSION = '1.0';
    const CLIENT_TIMEOUT = 30; // 10 sec
    const MIN_PHP_VERSION = 70100;
    const DS = '/';
    const END_POINT_URL = 'https://api.nimbuz.cm';
    const END_POINT_VERSION = 'v1';
    const APP_NAMESPACE = '\\Nimbuz\\Sms\\';
    const RESOURCE_VIEW = 'view';
    const RESOURCE_LIST = 'list';
    const RESOURCE_STATUS = 'dlr';
    const RESOURCE_BALANCE = 'balance';
    const RESPONSE_FORMAT = 'json';
    const ERROR_PHP_VERSION = 'Your PHP-Version belongs to a release that is no longer supported. You should upgrade your PHP version as soon as possible, as it may be exposed to unpatched security vulnerabilities';
    const SMS_MAX_RECIPIENTS = 50;
    const MAP_MOBILE =[\Nimbuz\Sms\Lib\Utils::class,'mapMobile'];
    const MAP_E164FORMAT =[\Nimbuz\Sms\Lib\Utils::class,'phoneNumberE164Format'];
    const PERSONLIZE_MSG_KEYS = ['%NAME%'];

    public static $asCredentialKeyWords = ['api_key', 'api_secret'];

    /**
    * @return string
    */
    public static function getPhpVersion() : string
    {
        if (!defined('PHP_VERSION_ID')) {
            $version = explode('.', PHP_VERSION); //@codeCoverageIgnore
            define('PHP_VERSION_ID', $version[0] * 10000 + $version[1] * 100 + $version[2]); //@codeCoverageIgnore
        }

        if (PHP_VERSION_ID < static::MIN_PHP_VERSION) {
            trigger_error(static::ERROR_PHP_VERSION, E_USER_ERROR);//@codeCoverageIgnore
        }

        return 'PHP/' . PHP_VERSION_ID;
    }

    public static function getSMSPath() : string
    {
        return dirname(__DIR__) .DIRECTORY_SEPARATOR;
    }
}
