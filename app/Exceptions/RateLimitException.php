<?php

namespace App\Exceptions;

use Exception;

class RateLimitException extends Exception
{
    protected $retryAfter;

    /**
     * CustomRateLimitException constructor.
     *
     * @param int $retryAfter
     * @param string $message
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct(int $retryAfter, $message = "Too many requests", $code = 429, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->retryAfter = $retryAfter;
    }

    /**
     * Get the exception's context information.
     *
     * @return array<string, mixed>
     */
    public function context(): array
    {
        return [
            'message' => $this->getMessage(),
            'retry_after' => $this->retryAfter
        ];
    }

    /**
     * Get the retry-after time.
     *
     * @return int
     */
    public function getRetryAfter(): int
    {
        return $this->retryAfter;
    }
}
