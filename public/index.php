<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;
use App\Controller\PurchaseItem as Controller_PurchaseItem;

$app = AppFactory::create();
$app->addErrorMiddleware(false, false, false);

$app->get('/',  Controller_PurchaseItem::class . ':listAllItems');



$app->run();