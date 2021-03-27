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
        return $this->renderHtml(FunctionsTrait::getPurchasedItems(), $response);
    }
}
