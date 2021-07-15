<?php
declare(strict_types=1);

namespace interactivemr\cintapiclient;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use interactivemr\cintapiclient\processor\ApiKeys;
use interactivemr\cintapiclient\processor\RootProcessor;
use interactivemr\cintapiclient\processor\PanelRootProcessor;
use interactivemr\cintapiclient\processor\RegisterUserProcessor;
use interactivemr\cintapiclient\processor\GetUserProcessor;
use interactivemr\cintapiclient\processor\FetchInvitationsProcessor;
use interactivemr\cintapiclient\processor\HttpKeys;

/**
 * A client for the Cint Panel API (https://cint-panel-api-cdp.readme.io/docs)
 * @author Sal Borrelli
 */
class CintApiClient {
    /**
     * URL to the Cint API
     */
    private $apiUrl = "";
    /**
     * API Key
     */
    private $apiKey = "";
    /**
     * API Secret
     */
    private $apiSecret = "";
    /**
     * API authentication string
     */
    private $apiAuth = "";
    /**
     * HTTP Client implementation
     */
    private $client = null;
    /**
     * Creates a new instance
     * @param string $apiUrl URL to the Cint API
     * @param string $apiKey API key
     * @param string $apiSecret API secret
     */
    public function __construct(string $apiUrl, string $apiKey, string $apiSecret)
    {
        $this->apiUrl = $apiUrl;
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
        $this->rebuildApiAuth();
        // initialize underlying HTTP client
        $this->client = new Client([
                'base_uri' => $apiUrl,
                'connect_timeout' => 5.0,
                'allow_redirects' => false,
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => 'Basic '.$this->getApiAuth()
                ],
                'synchronous' => true,
                'timeout' => 5.0
            ]);
    }
    
    /**
     * Gets the basic authentication token string
     * @return string the basic authentication token string
     */
    public function getApiAuth(): string {
        return $this->apiAuth;
    }
    
    /**
     * Gets the request parameters for basic authentication
     * @return array the request parameters for basic authentication
     */
    protected function getBasicAuthParams(): array {
        return ['auth' => 
            [
                $this->apiKey,
                $this->apiSecret,
                "basic"
            ]
        ];
    }
    
    /**
     * Rebuilds the API authentication string
     */
    private function rebuildApiAuth() {
        if (empty($this->apiKey) || empty($this->apiSecret)) {
            throw new \InvalidArgumentException("undefined API key and / or secret");
        }
        $this->apiAuth = base64_encode($this->apiKey.':'.$this->apiSecret);
    }
    
    /**
     * Gets the list of all resources provided by the API
     * @return array the list of API resources
     * @throws CintApiException if an error occurs
     */
    public function getApiResources() {
        $resources = [];
        try {
            $response = $this->client->get("/");
            $resources = (new RootProcessor())->process($response);
        } catch (RequestException $e) {
            throw new CintApiException("Error while fetching Root API resources.", $e->getCode(), $e);
        }
        return $resources;
    }
        
    /**
     * Gets the list of panel resources provided by the API
     * @return array the list of panel API resources
     * @throws CintApiException if an error occurs
     */
    public function getPanelApiResources() {
        $resources = [];
        try {
            $response = $this->client->get("/panels/".$this->apiKey);
            $resources = (new PanelRootProcessor())->process($response);
        } catch (RequestException $e) {
            throw new CintApiException("Error while fetching Panel API resources.", $e->getCode(), $e);
        }
        return $resources;
    }
    
    /**
     * Register a user to the panel
     * @param array $user information about the user to be registered
     * @return array information about the newly registered user as a panel member
     * @throws CintApiException if an error occurs
     */
    public function registerUser(array $user) {
        $memberInfo = [];
        try {
            $options = [
                HttpKeys::OPTION_JSON => [ ApiKeys::PANELIST => $user ],
                HttpKeys::OPTION_EXCEPTIONS => false
            ];
            $response = $this->client->post("/panels/".$this->apiKey."/panelists", $options);
            $memberInfo = (new RegisterUserProcessor())->process($response);
        } catch (RequestException $e) {
            throw new CintApiException("Error while registering a user to the panel.", $e->getCode(), $e);
        }
        return $memberInfo;
    }
    
    /**
     * Get data of a user from the panel
     * @param string $memberId member identifier as specified during the registration process
     * @return mixed an array containing information about the user, or FALSE if not found
     * @throws CintApiException if an error occurs
     */
    public function getUser(string $memberId) {
        $memberInfo = [];
        try {
            $options = [
                HttpKeys::OPTION_QUERY => [ ApiKeys::MEMBER_ID => $memberId ],
                HttpKeys::OPTION_EXCEPTIONS => false 
            ];
            $response = $this->client->get("/panels/".$this->apiKey."/panelists", $options);
            $memberInfo = (new GetUserProcessor())->process($response);
        } catch (RequestException $e) {
            throw new CintApiException("Error while registering a user to the panel.", $e->getCode(), $e);
        }
        return $memberInfo;
    }
    
    /**
     * Get data of a user from the panel, identified by email address
     * @param string $email member's email address as specified during the registration process
     * @return mixed an array containing information about the user, or FALSE if not found
     * @throws CintApiException if an error occurs
     */
    public function getUserByEmail(string $email) {
        $memberInfo = [];
        try {
            $options = [
                HttpKeys::OPTION_QUERY => [ ApiKeys::EMAIL => $email ],
                HttpKeys::OPTION_EXCEPTIONS => false
            ];
            $response = $this->client->get("/panels/".$this->apiKey."/panelists", $options);
            $memberInfo = (new GetUserProcessor())->process($response);
        } catch (RequestException $e) {
            throw new CintApiException("Error while registering a user to the panel.", $e->getCode(), $e);
        }
        return $memberInfo;
    }
    
    /**
     * Delete a user from the panel
     * @param int $key internal identifier assigned by Cint during the registration process 
     * @throws CintApiException if an error occurs
     */
    public function deleteUser(int $key) {
        try {
            $options = [ HttpKeys::OPTION_EXCEPTIONS => false ];
            $this->client->delete("/panels/".$this->apiKey."/panelists/".$key, $options);
        } catch (RequestException $e) {
            throw new CintApiException("Error while registering a user to the panel.", $e->getCode(), $e);
        }
    }
    
    /**
     * Get the list of invitations available for the panel members
     * @param int $since minimum identifier of events to fetch
     * @param int $limit maximum number of records to fetch
     * @return mixed an array list of invitations
     * @throws CintApiException if an error occurs
     */
    public function fetchInvitations(int $since = 0, int $limit = 10000) {
        $invitations = [];
        try {
            $client = $this->client;
            $processor = new FetchInvitationsProcessor();
            do {
                $lastEventId = $since;
                $options = [
                    HttpKeys::OPTION_QUERY => [ HttpKeys::OPTION_SINCE => $since, HttpKeys::OPTION_LIMIT => $limit ],
                    HttpKeys::OPTION_EXCEPTIONS => false
                ];
                $response = $client->get("/panels/".$this->apiKey."/events", $options);
                $curInvitations = $processor->process($response);
                if (!empty($curInvitations)) {
                    $invitations = array_merge($invitations, $curInvitations);
                }
                $since = $processor->getLastEventId();
            } while ((count($invitations)<$limit) && ($since!=$lastEventId));
            
        } catch (RequestException $e) {
            throw new CintApiException("Error while fetching invitations.", $e->getCode(), $e);
        }
        return $invitations;
    }
}

