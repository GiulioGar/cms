<?php
namespace interactivemr\cintapiclient;

use Throwable;

/**
 * The basic exception thrown by the API client if an error occurs during a request
 * @author Sal Borrelli
 */
class CintApiException extends \Exception {
    /**
     * Create a new instance
     * @param string $message error message
     * @param int $code error code
     * @param Throwable $previous previous exception
     */
    function __construct1(string $message = "", int $code = 0, Throwable $previous = NULL ) {
        parent::__construct($message, $code, $previous);
    }
}

