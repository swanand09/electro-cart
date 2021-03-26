<?php
    
// Should be set to 0 in production
error_reporting(E_ALL);

// Should be set to '0' in production
ini_set('display_errors', '1');
ini_set('display_startup_errors', 1);


// Settings
$settings = [];

// Path settings
$settings['root'] = dirname(__DIR__);
$settings['public'] = $settings['root'] . '/public';

// Error Handling Middleware settings
$settings['error'] = [
    
    // Should be set to false in production
    'display_error_details' => true,
    
    // Parameter is passed to the default ErrorHandler
    // View in rendered output by enabling the "displayErrorDetails" setting.
    // For the console and unit tests we also disable it
    'log_errors' => true,
    
    // Display error details in error log
    'log_error_details' => true,
];

// Twig settings
$settings['twig'] = [
	// Template paths
	'paths' => [
		__DIR__ . '/../src/view',
	],
	// Twig environment options
	'options' => [
		// Should be set to true in production
		'cache_enabled' => false,
		'cache_path' => __DIR__ . '/../var/cache/twig',
	],
];


return $settings;
