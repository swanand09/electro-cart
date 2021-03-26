<?php
 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);
require_once __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;
// use Slim\Views\Twig;
// use Slim\Http\Uri;
// use Slim\Http\Environment;

use Tracktik\Controller\PurchaseItem as Controller_PurchaseItem;

$app = AppFactory::create();


// Get container
$container = $app->getContainer();

// Register component on container
// $container['view'] = function ($container) {
//     $view = new Twig(__DIR__ .'/../src/view', [
//         'cache' => __DIR__ .'../var/cache/twig'
//     ]);

    
//     return $view;
// };

$app->addErrorMiddleware(true, false, false);

$app->get('/api/list-items-purchase/', Controller_PurchaseItem::class . ':apiGetItems');

$app->get('/', Controller_PurchaseItem::class . ':getItems');

$app->run();
