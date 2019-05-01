<?php

namespace App\Exception;

/**
 * Class HttpException
 * @package App\Exception
 */
class HttpException extends AddUserException
{
    /**
     * @var integer
     */
    private $httpCode;

    /**
     * @var string
     */
    private $httpMessage;

    /**
     * HttpException constructor.
     * @param string $message
     * @param int $httpCode
     * @param string $httpMessage
     */
    public function __construct($message = '', $httpCode = 200, $httpMessage = '')
    {
        $this->httpCode = $httpCode;
        $this->httpMessage = $httpMessage;
        parent::__construct($message);
    }

    /**
     * @return int
     */
    public function getHttpCode(): int
    {
        return $this->httpCode;
    }

    /**
     * @return string
     */
    public function getHttpMessage(): string
    {
        return $this->httpMessage;
    }
}