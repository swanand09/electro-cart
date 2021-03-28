<?php
namespace Tracktik\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Tracktik\BusinessLogic\Factory\Purchase;
use Tracktik\Controller\Abstracts\AppController as Abstract_AppController;

final class ApiPurchaseItem extends Abstract_AppController
{
    
    protected function renderContent(array $itemBought, Response $response) :Response
    {
        try {
            if (isset($itemBought['error'])) {
                throw new \ErrorException($itemBought['error']);
            }
            
            $response->getBody()->write(json_encode($itemBought, JSON_PRETTY_PRINT));
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
}
