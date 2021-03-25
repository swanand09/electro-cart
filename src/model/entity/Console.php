<?php
namespace Tracktik\Model\Entity;

use Tracktik\Model\Abstracts\ElectronicItem;

class Console extends ElectronicItem
{
    public function __construct()
    {
        $this->setType(self::ELECTRONIC_ITEM_CONSOLE);
        
        $this->setExtras(4);
    }
    
    protected function maxExtras()
    {
        return true;
    }
}
