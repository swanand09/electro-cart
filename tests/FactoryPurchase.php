<?php declare(strict_types=1);

namespace Tracktik\Tests;

use PHPUnit\Framework\TestCase;
use Tracktik\BusinessLogic\Factory\Purchase;
use Tracktik\Model\Entity\Television;

class FactoryPurchaseTest extends TestCase
{
    public function testFactoryPurchase()
    {
        $tv = Purchase::television(300.99);
       

        $this->assertSame(new Television(300.99),  $tv);
    }
}