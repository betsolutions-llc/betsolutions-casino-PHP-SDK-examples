<?php

require "vendor/autoload.php";


use Betsolutions\Casino\SDK\Exceptions\CantConnectToServerException;
use Betsolutions\Casino\SDK\Exceptions\JsonMappingException;
use Betsolutions\Casino\SDK\MerchantAuthInfo;
use Betsolutions\Casino\SDK\Slots\Campaigns\DTO\AddPlayersToSlotCampaignRequest;
use Betsolutions\Casino\SDK\Slots\Campaigns\DTO\CreateSlotCampaignRequest;
use Betsolutions\Casino\SDK\Slots\Campaigns\DTO\DeactivateSlotCampaignRequest;
use Betsolutions\Casino\SDK\Slots\Campaigns\DTO\GetSlotCampaignsRequest;
use Betsolutions\Casino\SDK\Slots\Campaigns\DTO\SlotCampaignBetAmountPerCurrency;
use Betsolutions\Casino\SDK\Slots\Campaigns\Enums\SlotCampaignStatus;
use Betsolutions\Casino\SDK\Slots\Campaigns\Services\SlotCampaignService;

//replace with real credentials
$merchantAuthInfo = new MerchantAuthInfo(456, 'https://api-staging.betsolutions.com', '34535354353E8C4744AD4941232165F9ADC5BCAA3C5CF141FAB4111565F68455A0');

createSlotCampaign($merchantAuthInfo);
deactivateSlotCampaign($merchantAuthInfo);
getSlotConfigs($merchantAuthInfo);
getSlotCampaigns($merchantAuthInfo);
addPlayersToSlotCampaigns($merchantAuthInfo);


function addPlayersToSlotCampaigns($merchantAuthInfo)
{
    $slotCampaignService = new SlotCampaignService($merchantAuthInfo);
    try {
        $result = $slotCampaignService->addPlayersToCampaign(new AddPlayersToSlotCampaignRequest(46, array('111452')));

        var_dump($result);
    } catch (CantConnectToServerException $ex) {
        echo $ex->getMessage();
        echo $ex->getHttpStatusCode();
    } catch (JsonMappingException $e) {
        echo $e->getMessage();
    }
}

function getSlotCampaigns($merchantAuthInfo)
{
    $slotCampaignService = new SlotCampaignService($merchantAuthInfo);
    try {

        $searchModel = new GetSlotCampaignsRequest(1, 10);
        $searchModel->statusId = SlotCampaignStatus::ACTIVE();
        $result = $slotCampaignService->getSlotCampaigns($searchModel);

        var_dump($result);
    } catch (CantConnectToServerException $ex) {
        echo $ex->getMessage();
        echo $ex->getHttpStatusCode();
    } catch (JsonMappingException $e) {
        echo $e->getMessage();
    }
}

function getSlotConfigs($merchantAuthInfo)
{
    $slotCampaignService = new SlotCampaignService($merchantAuthInfo);
    try {
        $result = $slotCampaignService->getSlotConfigs();

        var_dump($result);
    } catch (CantConnectToServerException $ex) {
        echo $ex->getMessage();
        echo $ex->getHttpStatusCode();
    } catch (JsonMappingException $e) {
        echo $e->getMessage();
    }
}

function deactivateSlotCampaign($merchantAuthInfo)
{
    $slotCampaignService = new SlotCampaignService($merchantAuthInfo);
    try {
        $result = $slotCampaignService->deactivateSlotCampaign(new DeactivateSlotCampaignRequest(45));

        var_dump($result);
    } catch (CantConnectToServerException $ex) {
        echo $ex->getMessage();
        echo $ex->getHttpStatusCode();
    } catch (JsonMappingException $e) {
        echo $e->getMessage();
    }
}

function createSlotCampaign($merchantAuthInfo)
{
    $slotCampaignService = new SlotCampaignService($merchantAuthInfo);
    $betAmountsPerCurrency = array(new SlotCampaignBetAmountPerCurrency(3, 7381, 'EUR'));
    $playerIds = array('111451');

    try {
        $result = $slotCampaignService->createSlotCampaign(new CreateSlotCampaignRequest(1, '08-26-2019 12:35:00', '07-26-2019 16:27:00', 10, 1, 's4564646464564564646464646464646fsf', $betAmountsPerCurrency, $playerIds, true));

        var_dump($result);
    } catch (CantConnectToServerException $ex) {
        echo $ex->getMessage();
        echo $ex->getHttpStatusCode();
    } catch (JsonMappingException $e) {
        echo $e->getMessage();
    }
}




