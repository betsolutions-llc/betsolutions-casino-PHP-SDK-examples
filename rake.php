<?php

require "vendor/autoload.php";

use Betsolutions\Casino\SDK\DTO\Rake\GetRakeRequest;
use Betsolutions\Casino\SDK\Exceptions\CantConnectToServerException;
use Betsolutions\Casino\SDK\Exceptions\JsonMappingException;
use Betsolutions\Casino\SDK\MerchantAuthInfo;
use Betsolutions\Casino\SDK\Services\RakeService;


//replace with real credentials
$merchantAuthInfo = new MerchantAuthInfo(456, 'https://api-staging.betsolutions.com', '34535354353E8C4744AD4941232165F9ADC5BCAA3C5CF141FAB4111565F68455A0');

getRake($merchantAuthInfo);

function getRake($merchantAuthInfo)
{
    $rakeService = new RakeService($merchantAuthInfo);

    try {
        $result = $rakeService->getRake(new GetRakeRequest());

        var_dump($result);
    } catch (CantConnectToServerException $ex) {
        echo $ex->getMessage();
        echo $ex->getHttpStatusCode();
    } catch (JsonMappingException $e) {
        echo $e->getMessage();
    }
}




