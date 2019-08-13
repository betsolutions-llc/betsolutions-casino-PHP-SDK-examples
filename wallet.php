<?php

require "vendor/autoload.php";

use Betsolutions\Casino\SDK\DTO\Wallet\DepositRequest;
use Betsolutions\Casino\SDK\DTO\Wallet\GetBalanceRequest;
use Betsolutions\Casino\SDK\DTO\Wallet\WithdrawRequest;
use Betsolutions\Casino\SDK\Exceptions\CantConnectToServerException;
use Betsolutions\Casino\SDK\Exceptions\JsonMappingException;
use Betsolutions\Casino\SDK\MerchantAuthInfo;
use Betsolutions\Casino\SDK\Services\WalletService;

//replace with real credentials
$merchantAuthInfo = new MerchantAuthInfo(456, 'https://api-staging.betsolutions.com', '34535354353E8C4744AD4941232165F9ADC5BCAA3C5CF141FAB4111565F68455A0');

//replace with real user info
$token = 'C0CF91DC286544F7A62DD935353453535379';
$userId = '518899';
$currency = 'EUR';

getBalance($merchantAuthInfo, $token, $userId, $currency);
deposit($merchantAuthInfo, $token, $userId, $currency, 'id1', 23);
withdraw($merchantAuthInfo, $token, $userId, $currency, 'id2', 45);

function withdraw($merchantAuthInfo, $token, $userId, $currency, $transactionId, $amount)
{
    $walletService = new WalletService($merchantAuthInfo);

    try {
        $result = $walletService->withdraw(new WithdrawRequest($amount, $transactionId, $token, $userId, $currency));

        var_dump($result);
    } catch (CantConnectToServerException $ex) {
        echo $ex->getMessage();
        echo $ex->getHttpStatusCode();
    } catch (JsonMappingException $e) {
        echo $e->getMessage();
    }
}

function deposit($merchantAuthInfo, $token, $userId, $currency, $transactionId, $amount)
{
    $walletService = new WalletService($merchantAuthInfo);

    try {
        $result = $walletService->deposit(new DepositRequest($amount, $transactionId, $token, $userId, $currency));

        var_dump($result);
    } catch (CantConnectToServerException $ex) {
        echo $ex->getMessage();
        echo $ex->getHttpStatusCode();
    } catch (JsonMappingException $e) {
        echo $e->getMessage();
    }
}

function getBalance($merchantAuthInfo, $token, $userId, $currency)
{
    $walletService = new WalletService($merchantAuthInfo);

    try {
        $result = $walletService->getBalance(new GetBalanceRequest($token, $userId, $currency));

        if (200 == $result->statusCode) {
            $balance = $result->data->balance;
            echo $balance;
        } else {
            echo "error";
        }

        var_dump($result);
    } catch (CantConnectToServerException $ex) {
        echo $ex->getMessage();
        echo $ex->getHttpStatusCode();
    } catch (JsonMappingException $e) {
        echo $e->getMessage();
    }
}





