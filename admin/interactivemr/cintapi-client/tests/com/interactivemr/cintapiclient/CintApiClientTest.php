<?php
declare(strict_types=1);
namespace interactivemr\cintapiclient;

use PHPUnit\Framework\TestCase;
use interactivemr\cintapiclient\processor\ApiKeys;
use interactivemr\cintapiclient\processor\HttpKeys;
use interactivemr\cintapiclient\processor\EventTypes;

final class CintApiClientTest extends TestCase
{
    const API_URL = "https://api.cint.com";
    const API_KEY = "c5886a77-7ee1-45ef-b919-f4464a4ac93d";
    const API_SECRET = "gRFry5s9UCwqT";
        
    protected function getApiAuth(): string {
        return base64_encode(self::API_KEY.':'.self::API_SECRET);
    }
    
    public function testRebuildApiAuth() {
        $client = new CintApiClient(self::API_URL, self::API_KEY, self::API_SECRET);
        $this->assertTrue($client->getApiAuth()===$this->getApiAuth(), "Authorization token generated from client should match real token.");
    }
    
    public function testGetRootApiResources() {
        $client = new CintApiClient(self::API_URL, self::API_KEY, self::API_SECRET);
        $resources = $client->getApiResources();
        $this->assertIsArray($resources, "Root API resources should be an array.");
        $this->assertArrayHasKey(ApiKeys::LINKS, $resources, "Root API resources should contain a list of links.");
        $this->assertNotEmpty($resources[ApiKeys::LINKS], "Root API resources should contain at least one link.");
    }
    
    public function testGetPanelApiResources() {
        $client = new CintApiClient(self::API_URL, self::API_KEY, self::API_SECRET);
        $resources = $client->getPanelApiResources();
        $this->assertIsArray($resources, "Panel API resources should be an array.");
        $this->assertArrayHasKey("panel", $resources, "Panel API resources should contain general information about the panel.");
        $this->assertArrayHasKey(ApiKeys::LINKS, $resources, "Panel API resources should contain a list of links.");
        $this->assertNotEmpty($resources[ApiKeys::LINKS], "Root API resources should contain at least one link.");
    }
    
    protected function createTestUser($memberId, $client) {
        $user = [
            "member_id" => $memberId,
            "first_name" => "Test",
            "last_name" => "User",
            "email_address" => "$memberId@interactive-mr.com",
            "gender" => "m",
            "postal_code" => "12345",
            "date_of_birth" => "1980-01-01",
            "phone_number" => "+39810123456",
            "street_address" => "Test Street, 1"
        ];
        return $client->registerUser($user);
    }
    
    public function testRegisterUser() {
        $client = new CintApiClient(self::API_URL, self::API_KEY, self::API_SECRET);
        $memberId = strtoupper(uniqid("CINT"));
        $memberInfo = $this->createTestUser($memberId, $client);
        $this->assertIsArray($memberInfo, "Member info should be an array.");
        $this->assertArrayHasKey(ApiKeys::PANELIST, $memberInfo, "Member info should contain general information about the new member.");
        $this->assertArrayHasKey(ApiKeys::LINKS, $memberInfo, "Member info should contain a list of links.");
        $this->assertNotEmpty($memberInfo[ApiKeys::LINKS], "Member info should contain at least one link.");
        $panelist = $memberInfo[ApiKeys::PANELIST];
        $this->assertArrayHasKey(ApiKeys::MEMBER_ID, $panelist, "Panelist should contain a member ID.");
        $this->assertEquals($panelist[ApiKeys::MEMBER_ID], $memberId, "Panelist's member ID should be equal to '$memberId'.");
    }
    
    public function testGetUser() {
        $client = new CintApiClient(self::API_URL, self::API_KEY, self::API_SECRET);
        // create test user
        $memberId = strtoupper(uniqid("CINT"));
        $this->createTestUser($memberId, $client);
        // get data of new user
        $memberInfo = $client->getUser($memberId);
        $this->assertIsArray($memberInfo, "Member info should be an array.");
        $this->assertArrayHasKey(ApiKeys::PANELIST, $memberInfo, "Member info should contain general information about the user.");
    }
    
    public function testGetUserByEmail() {
        $client = new CintApiClient(self::API_URL, self::API_KEY, self::API_SECRET);
        // create test user
        $memberId = strtoupper(uniqid("CINT"));
        $memberInfo = $this->createTestUser($memberId, $client);
        // get data of new user
        $panelist = $memberInfo[ApiKeys::PANELIST];
        $this->assertArrayHasKey(ApiKeys::EMAIL, $panelist, "Panelist should contain an email address.");
        $memberGetInfo = $client->getUserByEmail($panelist[ApiKeys::EMAIL]);
        $this->assertIsArray($memberGetInfo, "Member info should be an array.");
        $this->assertArrayHasKey(ApiKeys::PANELIST, $memberInfo, "Member info should contain general information about the user.");
        $uid = $panelist[ApiKeys::MEMBER_ID];
        $this->assertEquals($uid, $memberId, "Wrong user identifier: found ".$uid.", expected".$memberId.".");
    }
        
    public function testDeleteUser() {
        $client = new CintApiClient(self::API_URL, self::API_KEY, self::API_SECRET);
        // create user
        $memberId = strtoupper(uniqid("CINT"));
        $memberInfo = $this->createTestUser($memberId, $client);
        // get member key
        $this->assertArrayHasKey(ApiKeys::PANELIST, $memberInfo, "Member info should contain general information about the user.");
        $panelist = $memberInfo[ApiKeys::PANELIST];
        $this->assertArrayHasKey(ApiKeys::MEMBER_KEY, $panelist, "Panelist should contain a member KEY.");
        $memberKey = $panelist[ApiKeys::MEMBER_KEY];
        // delete user
        $client->deleteUser($memberKey);
        $memberInfo = $client->getUser($memberId);
        $this->assertEquals($memberInfo[HttpKeys::RESULT_SUCCESS], false, "User should NOT be a registered member of the panel.");
    }
    
    public function testFetchInvitations() {
        $client = new CintApiClient(self::API_URL, self::API_KEY, self::API_SECRET);
        $invitations = $client->fetchInvitations(0, 10);
        $this->assertIsArray($invitations, "Fetched invitations should be an array.");
        foreach($invitations as $inv) {
            $this->assertArrayHasKey(ApiKeys::TYPE, $invitations, "Invitation should declare a type.");
            $this->assertEquals($inv[ApiKeys::TYPE], EventTypes::INVITATION, "Wrong event type! Found '".$inv[ApiKeys::TYPE]."', expected '".EventTypes::INVITATION."'");
        }
    }
}