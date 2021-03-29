<?php

namespace Tracktik\Tests;

use Tracktik\Tests\TestTrait;
use PHPUnit\Framework\TestCase;

class TestController extends TestCase
{
    use TestTrait;

    /**
     * Test.
     *
     * @return void
     */
    public function testConsoleBought(): void
    {
    	

        // Create request with method and url
        $request = $this->createRequest('GET', '/console-bought/');

        // Make request and fetch response
        $response = $this->app->handle($request);

        // Asserts
        $this->assertSame(200, $response->getStatusCode());
    }
	
	/**
	 * Test.
	 *
	 * @return void
	 */
	public function testPurchaseItem(): void
	{
		
		
		// Create request with method and url
		$request = $this->createRequest('GET', '/');
		
		// Make request and fetch response
		$response = $this->app->handle($request);
		
		// Asserts
		$this->assertSame(200, $response->getStatusCode());
	}

   
}