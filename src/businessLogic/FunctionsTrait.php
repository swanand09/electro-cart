<?php
namespace Tracktik\BusinessLogic;

use Tracktik\BusinessLogic\Factory\Purchase;

trait FunctionsTrait
{
    public static function getPurchasedItems()
    {
        $purchasedItems = json_decode($_ENV['PURCHASED_ITEMS']);
        
        $sortedItems = [];
        
        foreach ($purchasedItems as $item) {
        	$electronicType = $item->type;
            $electronic = Purchase::$electronicType($item->price);
            if (!is_null($item->extras)) {
                $electronic->setExtras(count($item->extras));
                foreach ($item->extras as $extra) {
	                $electronicType = $extra->type;
                    $electronic->setListExtras(Purchase::$electronicType($extra->price, $extra->wired_type));
                }
            }
        }
        /*
        $televisionOne = Purchase::television(202.54);
        $televisionOne->setExtras(2);
        $televisionOne->setListExtras(Purchase::controller(10.99, 'remote'));
        $televisionOne->setListExtras(Purchase::controller(10.99, 'remote'));

        $televisionTwo = Purchase::television(430.95);
        $televisionTwo->setExtras(1);
        $televisionTwo->setListExtras(Purchase::controller(12.50, 'remote'));

        $console = Purchase::console(200.45);
        $console->setListExtras(Purchase::controller(7.89, 'remote'));
        $console->setListExtras(Purchase::controller(7.89, 'remote'));
        $console->setListExtras(Purchase::controller(9.99, 'wired'));
        $console->setListExtras(Purchase::controller(9.99, 'wired'));

        $items = [
                    $televisionOne,
                    $televisionTwo,
                    $console,
                    Purchase::microwave(123.99),
                ];

        $sortedItems = Purchase::getSortedItems($items, 'price');
        $totalPrice = Purchase::getTotalPrice($sortedItems);
        */
    }
}
