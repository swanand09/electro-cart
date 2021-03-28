<?php
declare(strict_types=1);
namespace Tracktik\Model\Entity;

use Tracktik\Model\Abstracts\ElectronicItem;
use Tracktik\Model\Interfaces\ExtraItem;

final class Console extends ElectronicItem implements ExtraItem, \JsonSerializable
{
    /**
    * @var array
    */
    private $listExtras;

    /**
     * @var float
     */
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

    public function addListExtras(ElectronicItem $extraItem)
    {
        $this->listExtras[] = $extraItem;
    }
    public function setListExtras($listExtras)
    {
        $this->listExtras = $listExtras;
    }
    public function getListExtras(): array
    {
        return $this->listExtras;
    }

    public function setTotalPrice(float $totalPrice)
    {
        $this->totalPrice = $totalPrice;
    }
    public function getTotalPrice():float
    {
        return $this->totalPrice;
    }
    
    public function JsonSerialize()
    {
        return [
                 "type"=> $this->getType(),
                 "extras"=>$this->getListExtras(),
                 "price" => $this->getPrice(),
                 "total_price"=>$this->getTotalPrice()
        ];
    }
}
