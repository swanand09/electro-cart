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
            if (isset($item->extras)) {
                $electronic->setExtras(count($item->extras));
                foreach ($item->extras as $extra) {
                    $electronicType = $extra->type;
                    $electronic->addListExtras(Purchase::$electronicType($extra->price, $extra->wired_type));
                }
                //Sort extras
                $electronic->setListExtras(Purchase::getSortedItems($electronic->getListExtras(), 'price'));

                //Caculate Total Price
                $electronic->setTotalPrice($electronic->getPrice()+Purchase::getTotalPrice($electronic->getListExtras()));
            }
            array_push($sortedItems, $electronic);
        }

        //Sort electronic items by price
        $sortedItems = Purchase::getSortedItems($sortedItems, 'price');
        //Calculate grand total price
        $totalPrice = Purchase::getTotalPrice($sortedItems);

        return compact(["sortedItems","totalPrice"]);
    }
}
