<?php

require "vendor/autoload.php";


use Betsolutions\Casino\SDK\Exceptions\CantConnectToServerException;
use Betsolutions\Casino\SDK\Exceptions\JsonMappingException;
use Betsolutions\Casino\SDK\MerchantAuthInfo;
use Betsolutions\Casino\SDK\TableGames\Backgammon\DTO\GetBackgammonAchievementsRequest;
use Betsolutions\Casino\SDK\TableGames\Backgammon\DTO\GetBackgammonTournamentsRequest;
use Betsolutions\Casino\SDK\TableGames\Backgammon\Enums\BackgammonAchievementType;
use Betsolutions\Casino\SDK\TableGames\Backgammon\Enums\BackgammonGameType;
use Betsolutions\Casino\SDK\TableGames\Backgammon\Enums\BackgammonTournamentType;
use Betsolutions\Casino\SDK\TableGames\Backgammon\Services\BackgammonAchievementService;
use Betsolutions\Casino\SDK\TableGames\Backgammon\Services\BackgammonTournamentService;


//replace with real credentials
$merchantAuthInfo = new MerchantAuthInfo(456, 'https://api-staging.betsolutions.com', '34535354353E8C4744AD4941232165F9ADC5BCAA3C5CF141FAB4111565F68455A0');

getBgTournaments($merchantAuthInfo);
getBgAchievements($merchantAuthInfo);

function getBgAchievements($merchantAuthInfo)
{
    $service = new BackgammonAchievementService($merchantAuthInfo);

    try {
        $searchModel = new GetBackgammonAchievementsRequest(1, 10);
        $searchModel->achievementTypeId = BackgammonAchievementType::DOUBLE_MARS();

        $result = $service->getAchievements($searchModel);

        var_dump($result);
    } catch (CantConnectToServerException $ex) {
        echo $ex->getHttpStatusCode();
    } catch (JsonMappingException $e) {
        echo $e->getMessage();
    }
}

function getBgTournaments($merchantAuthInfo)
{
    $service = new BackgammonTournamentService($merchantAuthInfo);

    try {
        $searchModel = new GetBackgammonTournamentsRequest(1, 10);
        $searchModel->gameTypeId = BackgammonGameType::EUROPEAN();
        $searchModel->tournamentTypeId = BackgammonTournamentType::SITANDGO();

        $result = $service->getTournaments($searchModel);

        var_dump($result);
    } catch (CantConnectToServerException $ex) {
        echo $ex->getHttpStatusCode();
    } catch (JsonMappingException $e) {
        echo $e->getMessage();
    }
}






