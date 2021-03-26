<?php
namespace Tracktik\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Tracktik\BusinessLogic\Factory\Purchase;
use Tracktik\BusinessLogic\ResponseFormat;

class PurchaseItem
{


    private function execute($itemsBought,Response $response) :Response
	{
		try{
			
			if(isset($itemsBought['error'])){
				throw new \ErrorException($itemsBought['error']);
			}
			
			$response->getBody()->write(json_encode($itemsBought,JSON_PRETTY_PRINT));
			return $response
				->withHeader('Content-Type', 'application/json')
				->withHeader('Access-Control-Allow-Origin', '*')
				->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
				->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
		} catch(\ErrorException $e){
			$response->getBody()->write(json_encode(["error"=>["text"=>$e->getMessage()]]));
			return $response
				->withHeader('Content-Type', 'application/json');
		}
	}

    public function listAllItems(Request $request, Response $response) :Response
    {
        $televisionOne = Purchase::television(202.54);
        $televisionOne->setExtras(2);
        $televisionOne->setListExtras(Purchase::controller('remote'));
        $televisionOne->setListExtras(Purchase::controller('remote`'));

        $televisionTwo = Purchase::television(430.95);
        $televisionTwo->setExtras(1);
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
        return $this->execute(compact([
                                "sortedItems","totalPrice"
                              ]),$response);
    }
}
