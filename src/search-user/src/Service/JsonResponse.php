<?php
declare(strict_types=1);

namespace App\Service;

/**
 * Class Response
 * @package App\service
 */
class JsonResponse
{
    /**
     * @var array
     */
    private $message;

    /**
     * @var bool
     */
    private $success;

    /**
     * @var int
     */
    private $statusCode;

    /**
     * JsonResponse constructor.
     * @param array $message
     * @param bool $success
     * @param int $statusCode
     */
    public function __construct(array $message, bool $success = true, int $statusCode = 200)
    {
        $this->message = $message;
        $this->success = $success;
        $this->statusCode = $statusCode;
    }

    /**
     * @return string
     */
    public function getContent(): string {
        return \json_encode(
            [
                'statusCode' => $this->statusCode,
                'message' => $this->message,
                'success' => $this->success
            ]
        );
    }
}
