<?php declare(strict_types=1);
namespace Tracktik\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Slim\Views\Twig;
use DI\Container;
use Tracktik\Controller\Abstracts\AppController as Abstract_AppController;

final class PurchaseItem extends Abstract_AppController
{
    /**
     * @var Twig
     */
    private $view;

    /**
     * @var string
     */
    private $template;

    public function __construct(Container $container)
    {
        $this->view = $container->get('view');
    }

    protected function renderContent($itemsBought, Response $response) :Response
    {
        try {
            return $this->view->render($response, $this->template, ["items"=>$itemsBought]);
        } catch (\ErrorException $e) {
            $response->getBody()->write(json_encode(["error"=>["text"=>$e->getMessage()]]));
            return $response
                ->withHeader('Content-Type', 'application/json');
        }
    }

    public function getPurchasedItems(Request $request, Response $response) :Response
    {
        $this->template =  'items_purchased.html.twig';
        return parent::getPurchasedItems($request, $response);
    }

    public function getConsoleBought(Request $request, Response $response) :Response
    {
        $this->template =  'console_purchased.html.twig';
        return parent::getConsoleBought($request, $response);
    }
}
