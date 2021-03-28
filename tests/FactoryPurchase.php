<?php
declare(strict_types=1);

namespace Tracktik\Tests;

use PHPUnit\Framework\TestCase;
use Tracktik\BusinessLogic\Factory\Purchase;
use Tracktik\Model\Entity\Television;
use Tracktik\Model\Entity\Controller;

final class FactoryPurchase extends TestCase
{
    public function testFactoryPurchase()
    {
        $tvPurchase = Purchase::television(300.99);
        $controllerPurchase= Purchase::controller(12.99,'wired');
        $tvPurchase->addListExtras($controllerPurchase);
        $tvPurchase->setListExtras(Purchase::getSortedItems($tvPurchase->getListExtras(),'price'));
        $tvPurchase->setTotalPrice($tvPurchase->getPrice()+Purchase::getTotalPrice($tvPurchase->getListExtras()));
       
        $tvEntity = new Television();
        $tvEntity->setPrice(300.99);
        $tvControllerEntity = new Controller();
        $tvControllerEntity->setWired('wired');
        $tvControllerEntity->setPrice(12.99);
        $tvEntity->addListExtras($tvControllerEntity);
        $tvEntity->setListExtras(Purchase::getSortedItems($tvEntity->getListExtras(),'price'));
        $tvEntity->setTotalPrice($tvEntity->getPrice()+Purchase::getTotalPrice($tvEntity->getListExtras()));


        $this->assertSame($tvEntity->getPrice(), $tvPurchase->getPrice());
        $this->assertSame($tvEntity->getListExtras()[0]->getPrice(), $tvPurchase->getListExtras()[0]->getPrice());
        $this->assertSame($controllerPurchase->getPrice(), $tvControllerEntity->getPrice());
        $this->assertSame($tvEntity->getTotalPrice(), $tvPurchase->getTotalPrice());
        
    }
}
