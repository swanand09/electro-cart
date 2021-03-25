<?php declare(strict_types=1);

namespace Tracktik\Tests;

use PHPUnit\Framework\Assert;
use Tracktik\BusinessLogic\Factory\Purchase;
use Tracktik\Model\Entity\Television;

class FactoryPurchaseTest extends Assert
{
    public function testFactoryPurchase()
    {
        $tv = Purchase::television(300.99);
       

        $this->assertSame(new Television(300.99),  $tv);
    }
}