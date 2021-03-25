<?php
namespace Tracktik\Controller\PurchaseItem;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Tracktik\BusinessLogic\Factory\Purchase;

class PurchaseItem
{
    public function listAllItems(Request $request, Response $response) :Response
    {
        $televisionOne = Purchase::television(202.54);
        $televisionOne->setListExtras(Purchase::controller('remote'));
        $televisionOne->setListExtras(Purchase::controller('remote`'));

        $televisionTwo = Purchase::television(430.95);
        $televisionTwo->setListExtras(Purchase::controller('remote'));

        $console = Purchase::console(200.45);
        $console->setListExtras(Purchase::controller('remote'));
        $console->setListExtras(Purchase::controller('remote'));
        $console->setListExtras(Purchase::controller('wired'));
        $console->setListExtras(Purchase::controller('wired'));

        $items = [
                    $televisionOne,
                    $televisionTwo,
                    $console,
                    Purchase::microwave(123.99),
                ];

        $sortedItems = Purchase::getSortedItems($items, 'price');
        $totalPrice = Purchase::getTotalPrice($sortedItems);
    }
}
