<?php
namespace Tracktik\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Tracktik\BusinessLogic\Factory\Purchase;
use Slim\Views\Twig;
use DI\Container;
class PurchaseItem
{
	private $view;

    public function __construct(Container $container)
    {
	    $this->view = $container->get('view');
    }

    private function renderHtml($itemsBought,Response $response) :Response
	{
		try{
			
			return $this->view->render($response, 'items_purchased.html.twig', ["items"=>$itemsBought]);
		} catch(\ErrorException $e){
			$response->getBody()->write(json_encode(["error"=>["text"=>$e->getMessage()]]));
			return $response
				->withHeader('Content-Type', 'application/json');
		}
	}


    public function getItems(Request $request, Response $response) :Response
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
        return $this->renderHtml(compact([
                                "sortedItems","totalPrice"
                              ]),$response);
    }
}
