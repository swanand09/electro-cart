<?php
namespace Tracktik\Model\Entity;

use Tracktik\Model\Abstracts\ElectronicItem; 

class Microwave extends ElectronicItem
{
    public function __construct()
    {
        $this->setType(self::ELECTRONIC_ITEM_MICROWAVE);
        $this->setExtras(0);
    }
    
    protected function maxExtras()
    {
        return true;
    }
}
