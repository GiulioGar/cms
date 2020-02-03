<?php
namespace interactivemr\cintapiclient\processor;

/**
 * HTTP Keys
 */
class HttpKeys {
    const RESULT_SUCCESS = "success";
    const RESULT_ERRORS = "errors";
    const OPTION_QUERY = "query";
    const OPTION_EXCEPTIONS = "exceptions";
    const OPTION_JSON = "json";
    const OPTION_SINCE = "since";
    const OPTION_LIMIT = "limit";
}

/**
 * Cint API Keys
 */
class ApiKeys {
    const LINKS = "links";
    const REL = "rel";
    const HREF = "href";
    const PANEL = "panel";
    const PANELIST = "panelist";
    const MEMBER_ID = "member_id";
    const MEMBER_KEY = "key";
    const ID = "id";
    const TYPE = "type";
    const EMAIL = "email_address";
}

/**
 * Type of events
 */
class EventTypes {
    const INVITATION = "invitation";
    const PANELIST_CREATED = "panelistcreated";
    const PANELIST_UNSUBSCRIBED = "panelistunsubscribed";
    const RESPONSENDT_STATUS_CHANGE = "respondentstatuschange";
    const TRANSACTION = "transaction";
}

