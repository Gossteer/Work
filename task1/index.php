<?php

$startTime = new DateTime('now');

include_once 'iConnectGet.php';
include_once 'iConnectSet.php';
include_once 'Singleton.php';
include_once 'GetConfig.php';
include_once 'Connect.php';
include_once 'ConnectOne.php';
include_once 'Invoice.php';
include_once 'InvoiceComposition.php';


$mysqlConnect = ConnectOne::getInstance();
//$mysqlConnect->fetchAll("CREATE DATABASE database_name CHARACTER SET utf8 COLLATE utf8_general_ci;", []);

echo $mysqlConnect->host_info() . "\n" ;

$invoces = new Invoice(353, 1, '06.11.1917');

for ($i = 1; $i < 3; $i++)
{
    $invoces->addInvoiceComposition($i, "name $i", $i, $i);
}
$invoces->saveBD($mysqlConnect);
//
//$invoces = new Invoice(34, 1);
//for ($i = 1; $i < 5; $i++)
//{
//    $invoces->addInvoiceComposition($i, "name $i", $i, $i);
//}
//$invoces->saveBD($mysqlConnect);

$invoces = Invoice::getInvoicesDBAll($mysqlConnect);
foreach ($invoces as $invoce)
{
    echo $invoce->getStatus() . "\n";
    echo $invoce->getDate() . "\n";
    foreach ($invoce as $invoc)
    {
        echo $invoc->name . "\n";
    }
}

$endTime = new DateTime('now');

echo $startTime->diff($endTime)->format('%S секунд, %f  микросекунд') . "кб\n";

echo memory_get_usage() / 1024  . "кб\n";

//1000 подходящих счетов = 1000 запросов к базе данных :(
//Один запрос с join = извороты с проверкой на уже созданный счёт, т.к иначе создаётся столько счетов, какого количество его составов.
//Так или иначе — вариант хороший и думаю с ним можно что-нибудь придумать.
//Большой потенциал оптимизации, улучшения читабельности кода и применение паттернов.