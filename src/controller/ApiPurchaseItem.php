<?php
namespace Tracktik\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Tracktik\BusinessLogic\Factory\Purchase;

class ApiPurchaseItem
{
    
    private function renderJson($itemsBought, Response $response) :Response
    {
        try {
            if (isset($itemsBought['error'])) {
                throw new \ErrorException($itemsBought['error']);
            }
            
            $response->getBody()->write(json_encode($itemsBought, JSON_PRETTY_PRINT));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withHeader('Access-Control-Allow-Origin', '*')
                ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
                ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
        } catch (\ErrorException $e) {
            $response->getBody()->write(json_encode(["error"=>["text"=>$e->getMessage()]]));
            return $response
                ->withHeader('Content-Type', 'application/json');
        }
    }


    public function apiGetItems(Request $request, Response $response) :Response
    {
        return $this->renderJson(Purchase::getPurchasedItems(), $response);
    }
}
