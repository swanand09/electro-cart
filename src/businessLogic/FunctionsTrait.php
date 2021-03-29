<?php
namespace Tracktik\BusinessLogic;

trait FunctionsTrait
{
    
    /**
     * get dummy data stored in .env to array format
     * @return array
     */
    public static function dummyData(): array
    {
        return json_decode($_ENV['PURCHASED_ITEMS']);
    }
}
