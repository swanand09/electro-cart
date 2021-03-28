<?php
declare(strict_types=1);
namespace Tracktik\Controller\Abstracts;

use Tracktik\Controller\Interfaces\AppController as Interface_AppController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Tracktik\BusinessLogic\Factory\Purchase;

abstract class AppController implements Interface_AppController
{
    abstract protected function renderContent(array $itemBought, Response $response);

    public function getPurchasedItems(Request $request, Response $response) :Response
    {
        return $this->renderContent(Purchase::getPurchasedItems(), $response);
    }

    public function getConsoleBought(Request $request, Response $response) :Response
    {
        return $this->renderContent(Purchase::getConsoleBought(), $response);
    }
}
