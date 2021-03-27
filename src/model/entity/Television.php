<?php
namespace Tracktik\Model\Entity;

use Tracktik\Model\Abstracts\ElectronicItem;
use Tracktik\Model\Interfaces\ExtraItem;

class Television extends ElectronicItem implements ExtraItem, \JsonSerializable
{
    /**
     * @var array
     */
    private $listExtras;

    /**
     * @var string
     */
    private $make;

    public function __construct()
    {
        $this->setType(self::ELECTRONIC_ITEM_TELEVISION);
    }
    
    protected function maxExtras()
    {
        return false;
    }

    public function setListExtras(ElectronicItem $extraItem)
    {
        $this->listExtras[] = $extraItem;
    }

    public function getListExtras(): array
    {
        return $this->listExtras;
    }

    public function setMake(string $make)
    {
        $this->make = $make;
    }
    public function getMake()
    {
        return $this->make;
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
