<?php

require "vendor/autoload.php";


use Betsolutions\Casino\SDK\Exceptions\CantConnectToServerException;
use Betsolutions\Casino\SDK\Exceptions\JsonMappingException;
use Betsolutions\Casino\SDK\MerchantAuthInfo;
use Betsolutions\Casino\SDK\TableGames\Domino\DTO\GetDominoAchievementsRequest;
use Betsolutions\Casino\SDK\TableGames\Domino\DTO\GetDominoTournamentsRequest;
use Betsolutions\Casino\SDK\TableGames\Domino\Enums\DominoGameType;
use Betsolutions\Casino\SDK\TableGames\Domino\Enums\DominoTournamentType;
use Betsolutions\Casino\SDK\TableGames\Domino\Services\DominoAchievementService;
use Betsolutions\Casino\SDK\TableGames\Domino\Services\DominoTournamentService;


//replace with real credentials
$merchantAuthInfo = new MerchantAuthInfo(456, 'https://api-staging.betsolutions.com', '34535354353E8C4744AD4941232165F9ADC5BCAA3C5CF141FAB4111565F68455A0');

getDominoTournaments($merchantAuthInfo);
getDominoAchievements($merchantAuthInfo);

function getDominoAchievements($merchantAuthInfo)
{
    $service = new DominoAchievementService($merchantAuthInfo);

    try {
        $searchModel = new GetDominoAchievementsRequest(1, 10);
        $result = $service->getAchievements($searchModel);

        var_dump($result);
    } catch (CantConnectToServerException $ex) {
        echo $ex->getHttpStatusCode();
    } catch (JsonMappingException $e) {
        echo $e->getMessage();
    }
}

function getDominoTournaments($merchantAuthInfo)
{
    $service = new DominoTournamentService($merchantAuthInfo);

    try {
        $searchModel = new GetDominoTournamentsRequest(1, 10);
        $searchModel->gameTypeId = DominoGameType::STANDARD();
        $searchModel->tournamentTypeId = DominoTournamentType::SITANDGO();

        $result = $service->getTournaments($searchModel);

        var_dump($result);
    } catch (CantConnectToServerException $ex) {
        echo $ex->getHttpStatusCode();
    } catch (JsonMappingException $e) {
        echo $e->getMessage();
    }
}







