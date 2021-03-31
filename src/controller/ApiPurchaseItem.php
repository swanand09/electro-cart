<?php
namespace Tracktik\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Tracktik\BusinessLogic\Factory\Purchase;
use Tracktik\Controller\Abstracts\AppController as Abstract_AppController;

final class ApiPurchaseItem extends Abstract_AppController
{
    
    /**
     * render content in json format for api
     * @param array $itemBought
     * @param Response $response
     * @return Response
     */
    protected function renderContent(array $itemBought, Response $response) :Response
    {
            $response->getBody()->write(json_encode($itemBought, JSON_PRETTY_PRINT));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withHeader('Access-Control-Allow-Origin', '*')
                ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
                ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
        
    }
	
	/**
	 * list electronics bought by type
	 * @param Request $request
	 * @param Response $response
	 * @return Response
	 */
	public function getPurchasedItem(Request $request, Response $response) :Response
	{
		return parent::getPurchasedItem($request, $response);
	}
	
	public function error(Request $request, Response $response):Response
	{
		$response->getBody()->write(json_encode(["error"=>["text"=>$request->getQueryParams()['error']]]));
		return $response
			->withHeader('Content-Type', 'application/json');
	}
}
