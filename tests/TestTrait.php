<?php

namespace Tracktik\Tests;

use DI\Container;
use InvalidArgumentException;
use JsonException;
use PHPUnit\Framework\MockObject\MockObject;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UriInterface;
use Slim\Factory\AppFactory;
use Slim\App;
use Slim\Psr7\Factory\ServerRequestFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Middlewares\TrailingSlash;
use UnexpectedValueException;
use Tracktik\Controller\PurchaseItem as Controller_PurchaseItem;
use Tracktik\Controller\ApiPurchaseItem as Controller_ApiPurchaseItem;
/**
 * App Test Trait.
 */
trait TestTrait
{
    /**
     * @var Container
     */
    protected Container $container;

    /**
     * @var App
     */
    protected App $app;

    /**
     * Bootstrap app.
     *
     * @throws UnexpectedValueException
     *
     * @return void
     */
    protected function setUp(): void
    {
	    $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__. '/../');
	    $dotenv->load();
        $this->container = new Container();
        AppFactory::setContainer($this->container);
	
	    $this->container->set('view', function () {
		    $twig =  Twig::create(__DIR__ . '/../src/view', [
			    'cache_enabled' => false,
			    'cache_path' => __DIR__ . '/../var/cache/twig',
			    'debug'=> true
		    ]);
		    $twig->addExtension(new \Twig\Extension\DebugExtension());
		    return $twig;
	    });
        
        $this->app = AppFactory::create();

        $this->app->add(new TrailingSlash(true));
	    $this->app->add(TwigMiddleware::createFromContainer($this->app));
	
	
	    $this->app->addErrorMiddleware(true, false, false);
	
	    $this->app->get('/api/list-items-purchase/', Controller_ApiPurchaseItem::class . ':getPurchasedItems');
	
	    $this->app->get('/api/console-bought/', Controller_ApiPurchaseItem::class  . ':getConsoleBought');
	
	    $this->app->get('/', Controller_PurchaseItem::class  . ':getPurchasedItems');
	
	    $this->app->get('/console-bought/', Controller_PurchaseItem::class  . ':getConsoleBought');
    }

    /**
     * Add mock to container.
     *
     * @param string $class The class or interface
     *
     * @return MockObject The mock
     */
    protected function mock(string $class): MockObject
    {
        if (!class_exists($class)) {
            throw new InvalidArgumentException(sprintf('Class not found: %s', $class));
        }

        $mock = $this->getMockBuilder($class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->container->set($class, $mock);

        return $mock;
    }

    /**
     * Create a server request.
     *
     * @param string $method The HTTP method
     * @param string|UriInterface $uri The URI
     * @param array $serverParams The server parameters
     *
     * @return ServerRequestInterface
     */
    protected function createRequest(
        string $method,
        $uri,
        array $serverParams = []
    ): ServerRequestInterface {
        return (new ServerRequestFactory())->createServerRequest($method, $uri, $serverParams);
    }

    /**
     * Create a JSON request.
     *
     * @param string $method The HTTP method
     * @param string|UriInterface $uri The URI
     * @param array|null $data The json data
     *
     * @return ServerRequestInterface
     */
    protected function createJsonRequest(
        string $method,
        $uri,
        array $data = null
    ): ServerRequestInterface {
        $request = $this->createRequest($method, $uri);

        if ($data !== null) {
            $request = $request->withParsedBody($data);
        }

        return $request->withHeader('Content-Type', 'application/json');
    }

    /**
     * Verify that the given array is an exact match for the JSON returned.
     *
     * @param array $expected The expected array
     * @param ResponseInterface $response The response
     *
     * @throws JsonException
     * @return void
     */
    protected function assertJsonData(array $expected, ResponseInterface $response): void
    {
        $actual = (string)$response->getBody();
        $this->assertSame($expected, (array)json_decode($actual, true, 512, JSON_THROW_ON_ERROR));
    }
}