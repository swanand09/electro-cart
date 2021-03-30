<?php

namespace Tracktik\Tests;

use JsonException;
use PHPUnit\Framework\TestCase;

class TestController extends TestCase
{
    use TestTrait;

    /**
     * @return void
     */
    public function testConsoleBought(): void
    {
        
        // Create request with method and url
        $request = $this->createRequest('GET', '/item-purchase/?type=console');

        // Make request and fetch response
        $response = $this->app->handle($request);

        // Asserts
        $this->assertSame(200, $response->getStatusCode());
    }
    
    /**
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
    
    /**
     *
     * @return void
     * @throws JsonException
     */
    public function testApiPurchaseItem(): void
    {
        
        // Create request with method and url
        $request = $this->createRequest('GET', '/api/list-items-purchase/');
        
        // Make request and fetch response
        $response = $this->app->handle($request);
        
        // Asserts
        $this->assertSame(200, $response->getStatusCode());
        
        $expected = (array)json_decode('{"sortedItems":{"12400":{"type":"microwave","price":123.99},"20047":{"type":"console","extras":{"790":{"type":"controller","wired_type":"remote","price":7.89},"1002":{"type":"controller","wired_type":"wired","price":9.99},"1003":{"type":"controller","wired_type":"wired","price":9.99},"1791":{"type":"controller","wired_type":"remote","price":17.89}},"price":200.45,"total_price":246.20999999999998},"20257":{"type":"television","extras":{"1100":{"type":"controller","wired_type":"remote","price":10.99},"1101":{"type":"controller","wired_type":"remote","price":10.99}},"price":202.54,"total_price":224.51999999999998},"43099":{"type":"television","extras":{"1251":{"type":"controller","wired_type":"remote","price":12.5}},"price":430.95,"total_price":443.45}},"totalPrice":1038.17}', true, 512, JSON_THROW_ON_ERROR);
     
        $this->assertJsonData($expected, $response);
    }
    
    /**
     * @return void
     * @throws JsonException
     */
    public function testApiConsoleBought(): void
    {
        
        // Create request with method and url
        $request = $this->createRequest('GET', '/api/item-purchase/?type=console');
        
        // Make request and fetch response
        $response = $this->app->handle($request);
        
        // Asserts
        $this->assertSame(200, $response->getStatusCode());
        
        $expected = (array)json_decode('[{"type":"console","extras":{"790":{"type":"controller","wired_type":"remote","price":7.89},"1002":{"type":"controller","wired_type":"wired","price":9.99},"1003":{"type":"controller","wired_type":"wired","price":9.99},"1791":{"type":"controller","wired_type":"remote","price":17.89}},"price":200.45,"total_price":246.20999999999998}]', true, 512, JSON_THROW_ON_ERROR);
        
        $this->assertJsonData($expected, $response);
    }
}
