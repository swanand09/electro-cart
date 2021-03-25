<?php
namespace Tracktik\Model\Entity;

use Tracktik\Model\Abstracts\ElectronicItem;

class Controller extends ElectronicItem
{
    public function __construct()
    {
        $this->setType(SELF::ELECTRONIC_ITEM_CONTROLLER);
        $this->setExtras(0);
    }
    
    protected function maxExtras()
    {
        return true;
    }
}
