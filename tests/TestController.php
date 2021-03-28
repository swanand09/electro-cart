<?php

namespace Tracktik\Tests;

use Tracktik\Tests\AppTestTrait;
use PHPUnit\Framework\TestCase;

class TestController extends TestCase
{
    use AppTestTrait;

    /**
     * Test.
     *
     * @return void
     */
    public function testPurchaseItem(): void
    {
    	

        // Create request with method and url
        $request = $this->createRequest('GET', '/api/list-items-purchase/');

        // Make request and fetch response
        $response = $this->app->handle($request);

        // Asserts
        $this->assertSame(200, $response->getStatusCode());
    }

   
}