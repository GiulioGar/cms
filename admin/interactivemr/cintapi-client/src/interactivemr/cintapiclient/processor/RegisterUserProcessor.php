<?php
namespace interactivemr\cintapiclient\processor;

/**
 * Response processor for "Register User" request
 * @author Sal Borrelli
 */

class RegisterUserProcessor extends ResponseProcessor {
    /**
     * {@inheritDoc}
     * @see \interactivemr\cintapiclient\processor\ResponseProcessor::process()
     */
    public function process($response) {
        $resp = parent::processLazy($response);
        $memberInfo = [];
        if (array_key_exists(ApiKeys::PANELIST, $resp)) {
            $memberInfo[HttpKeys::RESULT_SUCCESS] = true;
            $memberInfo[ApiKeys::PANELIST] = $resp[ApiKeys::PANELIST];
            if (array_key_exists(ApiKeys::LINKS, $resp)) {
                $memberInfo[ApiKeys::LINKS] = [];
                foreach($resp[ApiKeys::LINKS] as $link) {
                    $memberInfo[ApiKeys::LINKS][] = [
                        ApiKeys::REL => $link[ApiKeys::REL],
                        ApiKeys::HREF => $link[ApiKeys::HREF]
                    ];
                }
            }
        }
        else {
            $memberInfo[HttpKeys::RESULT_SUCCESS] = false;
            $memberInfo[HttpKeys::RESULT_ERRORS] = $resp;
        }
        return $memberInfo;
    }
}

