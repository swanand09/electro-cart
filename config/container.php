<?php
use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Factory\AppFactory;
use Slim\Middleware\ErrorMiddleware;

return [
'settings' => function () {
	return require __DIR__ . '/settings.php';
},

App::class => function (ContainerInterface $container) {
	AppFactory::setContainer($container);
	
	return AppFactory::create();
},

// Twig templates
Twig::class => function (ContainerInterface $container) {
	$settings = $container->get('settings');
	$twigSettings = $settings['twig'];
	
	$options = $twigSettings['options'];
	$options['cache'] = $options['cache_enabled'] ? $options['cache_path'] : false;
	
	$twig = Twig::create($twigSettings['paths'], $options);
	
	// Add extension here
	// ...
	
	return $twig;
},

ErrorMiddleware::class => function (ContainerInterface $container) {
	$app = $container->get(App::class);
	$settings = $container->get('settings')['error'];
	
	return new ErrorMiddleware(
		$app->getCallableResolver(),
		$app->getResponseFactory(),
		(bool)$settings['display_error_details'],
		(bool)$settings['log_errors'],
		(bool)$settings['log_error_details']
	);
},

];
