<?php
declare(strict_types=1);

namespace Nimbuz\Sms\Http;

use Nimbuz\Sms\Lib\Utils;

/**
 * Class Response
 *
 * @author CamooSarl
 */
class Response
{
    /** @var int $statusCode */
    private $statusCode;

    /** @var string $content */
    private $content;

    /** @var string */
    const BAD_STATUS = 'KO';

    /** @var array $data */
    protected $data;

    /**
     * @param string $content
     * @param int $statusCode
     */
    public function __construct(string $content = '', int $statusCode = 200)
    {
        $this->statusCode = $statusCode;
        $this->content = $content;
        $response = $this->getJson($content);
        $this->data = array_key_exists('response', $response)? $response['response'] : $response;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return (string) $this->content;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return (int) $this->statusCode;
    }

    /**
     * @return string
     */
    public function getResponseStatus()
    {
        if (array_key_exists('status', $this->data)) {
            return $this->data['status'];
        }

        return static::BAD_STATUS;
    }

    /**
     * @return array
     */
    public function getJson()
    {
        if ($this->getStatusCode() !== 200) {
            $message = $this->content !== ''? $this->content : 'request failed!';
            return ['status' => static::BAD_STATUS, 'message' => $message];
        }
        return $this->decodeJson($this->content, true);
    }

    /**
     * @param string $sJSON
     * @param $bAsHash
     *
     * @return array|stdClass
     */
    protected function decodeJson(string $sJSON, bool $bAsHash = false)
    {
        if ($this->content === '') {
            return $bAsHash === false? (object) [] : [];
        }
        return Utils::decodeJson($sJSON, $bAsHash);
    }
}
