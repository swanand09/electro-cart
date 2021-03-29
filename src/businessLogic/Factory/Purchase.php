<?php declare(strict_types=1);
namespace  Tracktik\BusinessLogic\Factory;

use Tracktik\BusinessLogic\ElectronicItems;
use Tracktik\BusinessLogic\FunctionsTrait;
use Tracktik\Model\Entity\Television;
use Tracktik\Model\Entity\Console;
use Tracktik\Model\Entity\Microwave;
use Tracktik\Model\Entity\Controller;

final class Purchase
{
    use FunctionsTrait;

    public static function television(float $price): Television
    {
        $television = new Television();
        $television->setPrice($price);

        return $television;
    }
   
    public static function console(float $price): Console
    {
        $console = new Console();
        $console->setPrice($price);

        return $console;
    }

    public static function microwave(float $price): Microwave
    {
        $microwave = new Microwave();
        $microwave->setPrice($price);

        return $microwave;
    }

    public static function controller(float $price, string $wired): Controller
    {
        $controller = new Controller();
        $controller->setPrice($price);
        $controller->setWired($wired);

        return $controller;
    }

    public static function getSortedItems(array $items, $sortType): array
    {
        $electronicItems = new ElectronicItems($items);
        return $electronicItems->getSortedItems($sortType);
    }

    public static function getTotalPrice(array $sortedItems): float
    {
        $totalPrice = 0.00;
        foreach ($sortedItems as $item) {
            if ($item->getExtras() > 0) {
                $totalPrice += $item->getTotalPrice();
            } else {
                $totalPrice += $item->getPrice();
            }
        }
        return $totalPrice;
    }

    
    public static function getPurchasedItems(): array
    {
        $sortedItems = [];
        
        foreach (FunctionsTrait::dummyData() as $item) {
            $electronicType = $item->type;
            $electronic = self::$electronicType($item->price);
    
            if (isset($item->make)) {
                $electronic->setMake($item->make);
            }
            
            if (isset($item->extras)) {
                $electronic->setExtras(count($item->extras));
                foreach ($item->extras as $extra) {
                    $electronicType = $extra->type;
                    $electronic->addListExtras(self::$electronicType($extra->price, $extra->wired_type));
                }
                //Sort extras
                $electronic->setListExtras(self::getSortedItems($electronic->getListExtras(), 'price'));

                //Caculate Total Price
                $electronic->setTotalPrice($electronic->getPrice() + self::getTotalPrice($electronic->getListExtras()));
            }
            array_push($sortedItems, $electronic);
        }

        //Sort electronic items by price
        $sortedItems = self::getSortedItems($sortedItems, 'price');

        //Calculate grand total price
        $totalPrice = self::getTotalPrice($sortedItems);

        return compact(["sortedItems", "totalPrice"]);
    }

    public static function getConsoleBought() : array
    {
        $purchasedItems =  self::getPurchasedItems();
        
        $electronicItems = new ElectronicItems($purchasedItems['sortedItems']);
        
        return $electronicItems->getItemsByType('console');
    }
}
