<?php
declare(strict_types=1);

namespace interactivemr\cintapiclient\processor;

use interactivemr\cintapiclient\CintApiException;

/**
 * Basic response processor 
 * @author Sal Borrelli
 */
class ResponseProcessor {
    /**
     * Class constants
     */
    public const HTTP_RESPONSE_OK = 200;
    public const HTTP_RESPONSE_NO_CONTENT = 204;
    public const HTTP_RESPONSE_UNPROCESSABLE_ENTITY = 402;
    
    /**
     * Process a response received from the Cint API. Only accepts responses with code OK as successful.
     * @param object $response the response received from the Cint API
     * @return array processed response body
     * @throws CintApiException if the HTTP response code was not OK.
     */
    protected function processStrict($response) {
        // check whether the request was successful
        $code = $response->getStatusCode();
        if ($code!=self::HTTP_RESPONSE_OK) {
            $reason = $response->getReasonPhrase();
            throw new CintApiException($reason, $code);
        }
        // return the decoded response
        return json_decode((string)$response->getBody(), true);
    }
    
    /**
     * Process a response received from the Cint API, regardless of the HTTP response code.
     * @param object $response the response received from the Cint API
     * @return array processed response body
     */
    protected function processLazy($response) {
        // return the decoded response
        return json_decode((string)$response->getBody(), true);
    }
    
    /**
     * Process a response received from the Cint API.
     * @param object $response the response received from the Cint API
     * @return array processed response body
     * @throws CintApiException if an error occurs
     */
    public function process($response) {
        return $this->processStrict($response);
    }
}

