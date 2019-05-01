<?php
declare(strict_types=1);

namespace App\Common\Model;

/**
 * Class ResponseModel
 * @package App\Common\Model
 */
class ResponseModel
{
    /**
     * @var integer
     */
    private $statusCode;

    /**
     * @var array
     */
    private $body;

    /**
     * ResponseModel constructor.
     * @param int $statusCode
     * @param array $body
     */
    public function __construct(int $statusCode, array $body)
    {
        $this->statusCode = $statusCode;
        $this->body = $body;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return array
     */
    public function getBody(): array
    {
        return $this->body;
    }
}
