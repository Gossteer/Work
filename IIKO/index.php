<?php

include_once 'MysqlConnect.php';
include_once 'Invoice.php';
include_once 'InvoiceComposition.php';


$mysqlConnect = new MysqlConnect('127.0.0.1', 'root', 'root');

$mysqlConnect->query("CREATE DATABASE database_name CHARACTER SET utf8 COLLATE utf8_general_ci;");

//echo $mysqlConnect->host_info . "\n" ;

$invoces = new Invoice(100, 1, '06.11.1917');

for ($i = 1; $i < 5; $i++)
{
    $invoces->addInvoiceComposition($i, "name $i", $i, $i);
}
$invoces->save($mysqlConnect);

$invoces = new Invoice(34, 1);
for ($i = 1; $i < 5; $i++)
{
    $invoces->addInvoiceComposition($i, "name $i", $i, $i);
}
$invoces->save($mysqlConnect);

$invoces = Invoice::getInvoicesDB($mysqlConnect, '*', "status = 'Оплачен' and date > '2020-01-01'");
foreach ($invoces as $invoce)
{
    echo $invoce->getStatus() . "\n";
    echo $invoce->getDate() . "\n";
    foreach ($invoce as $invoc)
    {
        echo $invoc->name . "\n";
    }
}

//1000 подходящих счетов = 1000 запросов к базе данных :(
//Один запрос с join = извороты с проверкой на уже созданный счёт, т.к иначе создаётся столько счетов, какого количество его составов.
//Так или иначе — вариант хороший и думаю с ним можно что-нибудь придумать.
//Большой потенциал оптимизации, улучшения читабельности кода и применение паттернов.