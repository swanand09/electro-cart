<?php
 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);
require_once __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;
use Tracktik\Controller\PurchaseItem as Controller_PurchaseItem;

$app = AppFactory::create();

$app->addErrorMiddleware(true, false, false);

$app->get('/', Controller_PurchaseItem::class . ':listAllItems');



$app->run();
