<?php
namespace Tracktik\Controller\PurchaseItem;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Tracktik\BusinessLogic\Factory\Purchase;

class PurchaseItem
{
    public function listAllItems(Request $request, Response $response) :Response
    {
        Purchase::television(202.54);
        Purchase::television(430.95);
        Purchase::console(200.45);
        Purchase::microwave(123.99);
    }
}
