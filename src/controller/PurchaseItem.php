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
	
	/**
	 * @var string
	 */
    private $error='';

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
       return $this->view->render($response, $this->template, ["items"=>$itemBought,'title'=>$this->title,'errorMsg'=>$this->error]);
    }

    public function getPurchasedItems(Request $request, Response $response) :Response
    {
        $this->template = 'items_purchased.html.twig';
        $this->title    = 'electronic items';
        return parent::getPurchasedItems($request, $response);
    }

    public function getPurchasedItem(Request $request, Response $response) :Response
    {
        if(!isset($request->getQueryParams()['error'])){

            $type = $request->getQueryParams()['type'];
            $this->template = 'item_purchased.html.twig';
            $this->title    = "{$type} items";
            return parent::getPurchasedItem($request, $response);
        }else{

            return $this->view->render($response, 'error.html.twig', ['title'=>'Error','errorMsg'=>$request->getQueryParams()['error']]);
        }
    }
    
}
