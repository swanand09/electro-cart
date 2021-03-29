<?php declare(strict_types=1);

namespace Tracktik\Tests;

use PHPUnit\Framework\TestCase;
use Tracktik\BusinessLogic\Factory\Purchase;
use Tracktik\Model\Entity\Console;
use Tracktik\Model\Entity\Television;
use Tracktik\Model\Entity\Controller;
use Tracktik\Model\Entity\Microwave;

final class TestFactoryPurchase extends TestCase
{
    /**
     * @test
     */
    public function assertPurchaseMethods()
    {
        $tvPurchase = Purchase::television(300.99);
        $this->assertInstanceOf(Television::class, $tvPurchase);
        
        $controllerPurchase= Purchase::controller(12.99, 'wired');
        $this->assertInstanceOf(Controller::class, $controllerPurchase);
        
        $tvPurchase->addListExtras($controllerPurchase);
        $tvPurchase->setListExtras(Purchase::getSortedItems($tvPurchase->getListExtras(), 'price'));
        $tvPurchase->setTotalPrice($tvPurchase->getPrice()+Purchase::getTotalPrice($tvPurchase->getListExtras()));
       
        $tvEntity = new Television();
        $tvEntity->setPrice(300.99);
        $tvControllerEntity = new Controller();
        $tvControllerEntity->setWired('wired');
        $tvControllerEntity->setPrice(12.99);
        $tvEntity->addListExtras($tvControllerEntity);
        $tvEntity->setListExtras(Purchase::getSortedItems($tvEntity->getListExtras(), 'price'));
        $tvEntity->setTotalPrice($tvEntity->getPrice()+Purchase::getTotalPrice($tvEntity->getListExtras()));
        
        $this->assertSame($tvEntity->getPrice(), $tvPurchase->getPrice());
    
    
        $consolePurchase = Purchase::console(200.99);
        $this->assertInstanceOf(Console::class, $consolePurchase);
    
        $controllerPurchase2  = Purchase::controller(7.99, 'wired');
        $this->assertInstanceOf(Controller::class, $controllerPurchase2);
    
        $consolePurchase->addListExtras($controllerPurchase);
        $consolePurchase->setListExtras(Purchase::getSortedItems($consolePurchase->getListExtras(), 'price'));
        $consolePurchase->setTotalPrice($consolePurchase->getPrice()+Purchase::getTotalPrice($consolePurchase->getListExtras()));
    
        $consoleEntity = new Console();
        $consoleEntity->setPrice(200.99);
        $consoleControllerEntity = new Controller();
        $consoleControllerEntity->setWired('wired');
        $consoleControllerEntity->setPrice(7.99);
        $consoleEntity->addListExtras($consoleControllerEntity);
        $consoleEntity->setListExtras(Purchase::getSortedItems($tvEntity->getListExtras(), 'price'));
        $consoleEntity->setTotalPrice($consoleEntity->getPrice()+Purchase::getTotalPrice($consoleEntity->getListExtras()));
    
        $this->assertSame($consoleEntity->getPrice(), $consolePurchase->getPrice());
       
        $this->assertSame($controllerPurchase2->getPrice(), $consoleControllerEntity->getPrice());
        $this->assertSame($consoleEntity->getTotalPrice(), $consolePurchase->getTotalPrice());

        
        $microwavePurchase = Purchase::microwave(105.45);
        $this->assertInstanceOf(Microwave::class, $microwavePurchase);
    
        $microwaveEntity = new Microwave();
        $microwaveEntity->setPrice(105.45);

        $this->assertSame($microwavePurchase->getPrice(), $microwaveEntity->getPrice());
    }
}
