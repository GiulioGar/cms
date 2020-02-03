<?php
namespace interactivemr\cintapiclient\processor;

/**
 * Response processor for "Events" request
 * @author Sal Borrelli
 */

class FetchInvitationsProcessor extends FetchEventsProcessor {
    /**
     * Create a new instance
     * @param string $type type of events to limit the processing to, or an empty string to  
     */
    function __construct() {
        $this->setEventType(EventTypes::INVITATION);
    }
}

