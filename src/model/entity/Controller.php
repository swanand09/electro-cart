<?php declare(strict_types=1);
namespace Tracktik\Model\Entity;

use Tracktik\Model\Abstracts\ElectronicItem;

final class Controller extends ElectronicItem implements \JsonSerializable
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
    
    public function JsonSerialize()
    {
        return [
            "type"=> $this->getType(),
            "wired_type" => $this->getWired(),
            "price" => $this->getPrice()
        ];
    }
}
