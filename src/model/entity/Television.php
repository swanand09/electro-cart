<?php
namespace Tracktik\Model\Entity;

use Tracktik\Model\Abstracts\ElectronicItem; 

class Television extends ElectronicItem
{
    public function __construct()
    {
        $this->setType(self::ELECTRONIC_ITEM_TELEVISION);
       
    }
    
    protected function maxExtras()
    {
        return true;
    }
}
