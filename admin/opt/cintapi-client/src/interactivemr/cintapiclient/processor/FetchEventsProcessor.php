<?php
namespace interactivemr\cintapiclient\processor;

/**
 * Response processor for "Events" request
 * @author Sal Borrelli
 */

class FetchEventsProcessor extends ResponseProcessor {
    /**
     * Type of events to limit the processing to 
     */
    private $eventType = "";
    
    /**
     * Identifier of last fetched event
     */
    private $lastEventId = 0;
    
    /**
     * Create a new instance
     * @param string $type type of events to limit the processing to, or an empty string to  
     */
    function __construct(string $eventType = "") {
        $this->setEventType($eventType);
    }
    
    /**
     * Get type of events to limit the processing to
     * @return string type of events to limit the processing to
     */
    public function getEventType() {
        return $this->eventType;
    }
    
    /**
     * Set type of events to limit the processing to
     * @param string $type type of events to limit the processing to
     */
    public function setEventType($eventType) {
        $this->eventType = $eventType;
    }

    /**
     * Get identifier of last fetched event
     * @return int identifier of last fetched event
     */
    public function getLastEventId() {
        return $this->lastEventId;
    }
    
    /**
     * Set identifier of last fetched event
     * @param int $lastEventId identifier of last fetched event
     */
    protected function setLastEventId($lastEventId) {
        $this->lastEventId = $lastEventId;
    }
    
    /**
     * {@inheritDoc}
     * @see \interactivemr\cintapiclient\processor\ResponseProcessor::process()
     */
    public function process($response) {
        $resp = parent::process($response);
        $eventType = $this->getEventType();
        $events = [];
        foreach($resp as $event) {
            $this->setLastEventId(intval($event[ApiKeys::ID]));
            if (empty($eventType) || (array_key_exists(ApiKeys::TYPE, $event) && ($event[ApiKeys::TYPE]===$eventType))) {
                // add event to result
                $events[] = $event;
            }
        }
        return $events;
    }
}

