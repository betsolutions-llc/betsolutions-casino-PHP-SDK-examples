<?php

require "vendor/autoload.php";


use Betsolutions\Casino\SDK\Exceptions\CantConnectToServerException;
use Betsolutions\Casino\SDK\Exceptions\JsonMappingException;
use Betsolutions\Casino\SDK\MerchantAuthInfo;
use Betsolutions\Casino\SDK\TableGames\Okey\DTO\GetOkeyAchievementsRequest;
use Betsolutions\Casino\SDK\TableGames\Okey\DTO\GetOkeyTournamentsRequest;
use Betsolutions\Casino\SDK\TableGames\Okey\Enums\OkeyGameType;
use Betsolutions\Casino\SDK\TableGames\Okey\Enums\OkeyTournamentType;
use Betsolutions\Casino\SDK\TableGames\Okey\Services\OkeyAchievementService;
use Betsolutions\Casino\SDK\TableGames\Okey\Services\OkeyTournamentService;


//replace with real credentials
$merchantAuthInfo = new MerchantAuthInfo(456, 'https://api-staging.betsolutions.com', '34535354353E8C4744AD4941232165F9ADC5BCAA3C5CF141FAB4111565F68455A0');

getOkeyTournaments($merchantAuthInfo);
getOkeyAchievements($merchantAuthInfo);

function getOkeyAchievements($merchantAuthInfo)
{
    $service = new OkeyAchievementService($merchantAuthInfo);

    try {
        $searchModel = new GetOkeyAchievementsRequest(1, 10);
        $result = $service->getAchievements($searchModel);

        var_dump($result);
    } catch (CantConnectToServerException $ex) {
        echo $ex->getHttpStatusCode();
    } catch (JsonMappingException $e) {
        echo $e->getMessage();
    }
}

function getOkeyTournaments($merchantAuthInfo)
{
    $service = new OkeyTournamentService($merchantAuthInfo);

    try {
        $searchModel = new GetOkeyTournamentsRequest(1, 10);
        $searchModel->gameTypeId = OkeyGameType::STANDARD();
        $searchModel->tournamentTypeId = OkeyTournamentType::SITANDGO();

        $result = $service->getTournaments($searchModel);

        var_dump($result);
    } catch (CantConnectToServerException $ex) {
        echo $ex->getHttpStatusCode();
    } catch (JsonMappingException $e) {
        echo $e->getMessage();
    }
}








