<?php declare(strict_types=1);
namespace Tracktik\Model\Entity;

use Tracktik\Model\Abstracts\ElectronicItem;

final class Microwave extends ElectronicItem implements \JsonSerializable
{
    public function __construct()
    {
        $this->setType(self::ELECTRONIC_ITEM_MICROWAVE);
        $this->setExtras(0);
    }
    
    protected function maxExtras()
    : bool
    {
        return true;
    }
    
    public function JsonSerialize()
    {
        return [
            "type"=> $this->getType(),
            "price" => $this->getPrice()
        ];
    }
}
