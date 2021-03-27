<?php
declare(strict_types=1);

namespace  Tracktik\BusinessLogic\Factory;

use Tracktik\BusinessLogic\ElectronicItems;
use Tracktik\Model\Entity\Television;
use Tracktik\Model\Entity\Console;
use Tracktik\Model\Entity\Microwave;
use Tracktik\Model\Entity\Controller;

class Purchase
{
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
            if ($item->getExtras()>0) {
                $totalPrice += $item->getTotalPrice();
            } else {
                $totalPrice += $item->getPrice();
            }
        }
        return $totalPrice;
    }
}
