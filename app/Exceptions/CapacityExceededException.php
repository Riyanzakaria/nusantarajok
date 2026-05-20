<?php

namespace App\Exceptions;

use Carbon\Carbon;

/**
 * CapacityExceededException
 *
 * Thrown when a work order cannot be scheduled because
 * the requested date has insufficient capacity.
 * Carries the earliest available date for the UI to suggest.
 */
class CapacityExceededException extends \RuntimeException
{
    public function __construct(
        string $message,
        public readonly Carbon $earliestAvailableDate,
        int $code = 0,
        ?\Throwable $previous = null,
    ) {
        parent::__construct($message, $code, $previous);
    }
}
