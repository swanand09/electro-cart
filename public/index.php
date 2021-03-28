<?php
 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);
require_once __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Middlewares\TrailingSlash;
use DI\Container;

use Tracktik\Controller\PurchaseItem as Controller_PurchaseItem;
use Tracktik\Controller\ApiPurchaseItem as Controller_ApiPurchaseItem;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__. '/../');
$dotenv->load();

// Create Container
$container = new Container();
AppFactory::setContainer($container);

// Register component on container
$container->set('view', function () {
    $twig =  Twig::create(__DIR__ . '/../src/view', [
        'cache_enabled' => false,
        'cache_path' => __DIR__ . '/../var/cache/twig',
        'debug'=> true
    ]);
    $twig->addExtension(new \Twig\Extension\DebugExtension());
    return $twig;
});
$app = AppFactory::create();

$app->add(new TrailingSlash(true));

$app->add(TwigMiddleware::createFromContainer($app));

$app->addErrorMiddleware(true, false, false);

$app->get('/api/list-items-purchase/', Controller_ApiPurchaseItem::class . ':getPurchasedItems');

$app->get('/', Controller_PurchaseItem::class  . ':getPurchasedItems');

$app->get('/console-bought/', Controller_PurchaseItem::class  . ':getConsoleBought');

$app->run();
