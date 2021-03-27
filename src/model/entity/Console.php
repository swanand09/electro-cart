<?php
namespace Tracktik\Model\Entity;

use Tracktik\Model\Abstracts\ElectronicItem;
use Tracktik\Model\Interfaces\ExtraItem;

class Console extends ElectronicItem implements ExtraItem, \JsonSerializable
{
    /**
    * @var array
    */
    private $listExtras;

    private $totalPrice;

    public function __construct()
    {
        $this->setType(self::ELECTRONIC_ITEM_CONSOLE);
        
        $this->setExtras(4);
    }
    
    protected function maxExtras()
    {
        return true;
    }

    public function setListExtras(ElectronicItem $extraItem)
    {
        $this->listExtras[] = $extraItem;
    }
    public function getListExtras(): array
    {
        return $this->listExtras;
    }

    public function setTotalPrice(float $totalPrice)
    {
        $this->totalPrice = $totalPrice;
    }
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }
    
    public function JsonSerialize()
    {
        return [
                 "type"=> $this->getType(),
                 "extras"=>$this->getListExtras(),
                 "price" => $this->getPrice()
        ];
    }
}
