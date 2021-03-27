<?php
declare(strict_types=1);
namespace Tracktik\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Tracktik\BusinessLogic\Factory\Purchase;
use Tracktik\BusinessLogic\FunctionsTrait;
use Slim\Views\Twig;
use DI\Container;

class PurchaseItem
{
    use FunctionsTrait;

    private $view;

    public function __construct(Container $container)
    {
        $this->view = $container->get('view');
    }

    private function renderHtml($itemsBought, Response $response) :Response
    {
        try {
            return $this->view->render($response, 'items_purchased.html.twig', ["items"=>$itemsBought]);
        } catch (\ErrorException $e) {
            $response->getBody()->write(json_encode(["error"=>["text"=>$e->getMessage()]]));
            return $response
                ->withHeader('Content-Type', 'application/json');
        }
    }


    public function getItems(Request $request, Response $response) :Response
    {
        $purchasedItems = FunctionsTrait::getPurchasedItems();
        die();

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
        return $this->renderHtml(compact([
                                "sortedItems","totalPrice"
                              ]), $response);
    }
}
