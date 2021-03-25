<?php
declare(strict_types=1);

namespace  Tracktik\BusinessLogic\Factory;

use Tracktik\BusinessLogic\ElectronicItems;
use Tracktik\Model\Entity\Television;
use Tracktik\Model\Entity\Console;
use Tracktik\Model\Entity\Microwave;

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
}
