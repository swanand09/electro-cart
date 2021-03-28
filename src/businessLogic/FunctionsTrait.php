<?php
namespace Tracktik\BusinessLogic;

trait FunctionsTrait
{
    public static function dummyData()
    {
        return json_decode($_ENV['PURCHASED_ITEMS']);
    }
}
