<?php

require "vendor/autoload.php";


use Betsolutions\Casino\SDK\Exceptions\CantConnectToServerException;
use Betsolutions\Casino\SDK\Exceptions\JsonMappingException;
use Betsolutions\Casino\SDK\MerchantAuthInfo;
use Betsolutions\Casino\SDK\TableGames\Bura\DTO\GetBuraAchievementsRequest;
use Betsolutions\Casino\SDK\TableGames\Bura\DTO\GetBuraTournamentsRequest;
use Betsolutions\Casino\SDK\TableGames\Bura\Enums\BuraAchievementType;
use Betsolutions\Casino\SDK\TableGames\Bura\Enums\BuraGameType;
use Betsolutions\Casino\SDK\TableGames\Bura\Enums\BuraTournamentType;
use Betsolutions\Casino\SDK\TableGames\Bura\Services\BuraAchievementService;
use Betsolutions\Casino\SDK\TableGames\Bura\Services\BuraTournamentService;


//replace with real credentials
$merchantAuthInfo = new MerchantAuthInfo(456, 'https://api-staging.betsolutions.com', '34535354353E8C4744AD4941232165F9ADC5BCAA3C5CF141FAB4111565F68455A0');

getBuraTournaments($merchantAuthInfo);
getBuraAchievements($merchantAuthInfo);

function getBuraAchievements($merchantAuthInfo)
{
    $service = new BuraAchievementService($merchantAuthInfo);

    try {
        $searchModel = new GetBuraAchievementsRequest(1, 10);
        $searchModel->achievementTypeId = BuraAchievementType::MOLODKA();

        $result = $service->getAchievements($searchModel);

        var_dump($result);
    } catch (CantConnectToServerException $ex) {
        echo $ex->getHttpStatusCode();
    } catch (JsonMappingException $e) {
        echo $e->getMessage();
    }
}

function getBuraTournaments($merchantAuthInfo)
{
    $service = new BuraTournamentService($merchantAuthInfo);

    try {
        $searchModel = new GetBuraTournamentsRequest(1, 10);
        $searchModel->gameTypeId = BuraGameType::FIVE_CARD();
        $searchModel->tournamentTypeId = BuraTournamentType::SITANDGO();

        $result = $service->getTournaments($searchModel);

        var_dump($result);
    } catch (CantConnectToServerException $ex) {
        echo $ex->getHttpStatusCode();
    } catch (JsonMappingException $e) {
        echo $e->getMessage();
    }
}







