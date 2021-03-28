<?php
namespace Tracktik\Controller\Interfaces;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

interface AppController
{
    public function getPurchasedItems(Request $request, Response $response);
    public function getConsoleBought(Request $request, Response $response);
}