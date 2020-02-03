<?php
namespace interactivemr\cintapiclient\processor;

/**
 * Response processor for "Panel API Root" request
 * @author Sal Borrelli
 */

class PanelRootProcessor extends ResponseProcessor {
    /**
     * {@inheritDoc}
     * @see \interactivemr\cintapiclient\processor\ResponseProcessor::process()
     */
    public function process($response) {
        $resp = parent::process($response);
        $resources = [];
        if (array_key_exists(ApiKeys::PANEL, $resp)) {
            $resources[ApiKeys::PANEL] = $resp[ApiKeys::PANEL];
        }
        if (array_key_exists(ApiKeys::LINKS, $resp)) {
            $resources[ApiKeys::LINKS] = [];
            foreach($resp[ApiKeys::LINKS] as $link) {
                $resources[ApiKeys::LINKS][] = [
                    ApiKeys::REL => $link[ApiKeys::REL],
                    ApiKeys::HREF => $link[ApiKeys::HREF]
                ];             
            }
        }
        return $resources;
    }
}

