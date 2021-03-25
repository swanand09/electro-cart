<?php
namespace App\Model\Entity;

use App\Model\Abstracts\ElectronicItem;

class Console extends ElectronicItem
{
    public function __construct(float $price)
    {
        $this->setType(self::ELECTRONIC_ITEM_MICROWAVE);
        $this->setPrice($price);
        $this->setWired(true);
        $this->setExtras(4);
    }
    
    protected function maxExtras()
    {
        return true;
    }
}
