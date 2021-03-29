<?php declare(strict_types=1);
namespace Tracktik\Model\Entity;

use Tracktik\Model\Abstracts\ElectronicItem;
use Tracktik\Model\Interfaces\ExtraItem;

final class Television extends ElectronicItem implements ExtraItem, \JsonSerializable
{
    /**
     * @var array
     */
    private array $extraItems;

    private float $totalPrice;

    public function __construct()
    {
        $this->setType(self::ELECTRONIC_ITEM_TELEVISION);
    }
    
    protected function maxExtras(): bool
    {
        return false;
    }

    public function addListExtras(ElectronicItem $extraItem)
    {
        $this->extraItems[] = $extraItem;
    }
    public function setListExtras($extraItems)
    {
        $this->extraItems = $extraItems;
    }
    public function getListExtras(): array
    {
        return $this->extraItems;
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
