<?php

require "vendor/autoload.php";


use Betsolutions\Casino\SDK\Exceptions\CantConnectToServerException;
use Betsolutions\Casino\SDK\Exceptions\JsonMappingException;
use Betsolutions\Casino\SDK\MerchantAuthInfo;
use Betsolutions\Casino\SDK\TableGames\Seka\DTO\GetSekaAchievementsRequest;
use Betsolutions\Casino\SDK\TableGames\Seka\DTO\GetSekaTournamentsRequest;
use Betsolutions\Casino\SDK\TableGames\Seka\Enums\SekaGameType;
use Betsolutions\Casino\SDK\TableGames\Seka\Enums\SekaTournamentType;
use Betsolutions\Casino\SDK\TableGames\Seka\Services\SekaAchievementService;
use Betsolutions\Casino\SDK\TableGames\Seka\Services\SekaTournamentService;

//replace with real credentials
$merchantAuthInfo = new MerchantAuthInfo(456, 'https://api-staging.betsolutions.com', '34535354353E8C4744AD4941232165F9ADC5BCAA3C5CF141FAB4111565F68455A0');

getSekaTournaments($merchantAuthInfo);
getSekaAchievements($merchantAuthInfo);

function getSekaAchievements($merchantAuthInfo)
{

    $service = new SekaAchievementService($merchantAuthInfo);
    try {
        $searchModel = new GetSekaAchievementsRequest(1, 10);
        $result = $service->getAchievements($searchModel);

        var_dump($result);
    } catch (CantConnectToServerException $ex) {
        echo $ex->getHttpStatusCode();
    } catch (JsonMappingException $e) {
        echo $e->getMessage();
    }
}

function getSekaTournaments($merchantAuthInfo)
{
    $service = new SekaTournamentService($merchantAuthInfo);
    try {
        $searchModel = new GetSekaTournamentsRequest(1, 10);
        $searchModel->gameTypeId = SekaGameType::WITH_FIKE();
        $searchModel->tournamentTypeId = SekaTournamentType::SITANDGO();

        $result = $service->getTournaments($searchModel);

        var_dump($result);
    } catch (CantConnectToServerException $ex) {
        echo $ex->getHttpStatusCode();
    } catch (JsonMappingException $e) {
        echo $e->getMessage();
    }
}







