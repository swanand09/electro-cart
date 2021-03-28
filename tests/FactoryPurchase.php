<?php
declare(strict_types=1);

namespace Tracktik\Tests;

use PHPUnit\Framework\TestCase;
use Tracktik\BusinessLogic\Factory\Purchase;
use Tracktik\Model\Entity\Television;

final class FactoryPurchase extends TestCase
{
    public function testFactoryPurchase()
    {
        $tv = Purchase::television(300.99);
       
        $tv1 = new Television();
        $tv1->setPrice(300.99);

        $this->assertSame($tv1->getPrice(), $tv->getPrice());
    }
}
