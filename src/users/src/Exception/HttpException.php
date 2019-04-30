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
     * HttpException constructor.
     * @param string $message
     * @param int $httpCode
     */
    public function __construct($message = '', $httpCode = 200)
    {
        $this->httpCode = $httpCode;
        parent::__construct($message);
    }

    /**
     * @return int
     */
    public function getHttpCode(): int
    {
        return $this->httpCode;
    }
}