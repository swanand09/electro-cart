<?php
use Slim\App;
use Tracktik\Controller\PurchaseItem as Controller_PurchaseItem;

return function (App $app) {
	$app->get('/', Controller_PurchaseItem::class  . ':getItems');
};