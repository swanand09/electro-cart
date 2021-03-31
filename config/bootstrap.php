<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Slim\Routing\RouteContext;
use Middlewares\TrailingSlash;
use DI\Container;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\UriInterface;
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

$middlewareHandleReq = function  (Request $request, RequestHandler $handler) use($app) {

    try{

        $param = $request->getQueryParams();
        if (isset($param['type']) && !empty($param['type'])) {
			
			return $handler->handle($request);
		}
        throw new \ErrorException("Please add a non empty parameter called 'type'!");
    }catch(\ErrorException $e){
       
    	$newRequest = $request->withQueryParams(["error"=>$e->getMessage()]);
	    $routeContext = RouteContext::fromRequest($newRequest);
	    $route = $routeContext->getRoute();
	    $callable = explode(':',$route->getCallable());
	    $route->setCallable($callable[0]  . ':error');
	    $route->setPattern('/error/');
	    return $handler->handle($newRequest);
     
    }
};



//solve problem of slash at the endpoint of url
$app->add(new TrailingSlash(true));

$app->add(TwigMiddleware::createFromContainer($app));

$app->addErrorMiddleware(true, false, false);

$app->get('/api/list-items-purchase/', Controller_ApiPurchaseItem::class . ':getPurchasedItems');

$app->get('/api/item-purchase/[?type]', Controller_ApiPurchaseItem::class  . ':getPurchasedItem')->add($middlewareHandleReq);

$app->get('/', Controller_PurchaseItem::class  . ':getPurchasedItems');

$app->get('/item-purchase/[?type]', Controller_PurchaseItem::class  . ':getPurchasedItem')->add($middlewareHandleReq);

$app->get('/error/',Controller_PurchaseItem::class  . ':error');

return $app;
