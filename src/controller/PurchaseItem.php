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

    /**
    * @var string
    */
    private $title;

    public function __construct(Container $container)
    {
        $this->view = $container->get('view');
    }
    
    /**
     * render content in twig template
     * @param array $itemBought
     * @param Response $response
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    protected function renderContent(array $itemBought, Response $response) :Response
    {
        try {
            return $this->view->render($response, $this->template, ["items"=>$itemBought,'title'=>$this->title]);
        } catch (\ErrorException $e) {
            $response->getBody()->write(json_encode(["error"=>["text"=>$e->getMessage()]]));
            return $response
                ->withHeader('Content-Type', 'application/json');
        }
    }

    public function getPurchasedItems(Request $request, Response $response) :Response
    {
        $this->template = 'items_purchased.html.twig';
        $this->title    = 'electronic items';
        return parent::getPurchasedItems($request, $response);
    }

    public function getConsoleBought(Request $request, Response $response) :Response
    {
        $this->template = 'console_purchased.html.twig';
        $this->title    = 'console items';
        return parent::getConsoleBought($request, $response);
    }
}
