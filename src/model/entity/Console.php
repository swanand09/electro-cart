<?php
namespace Tracktik\Model\Entity;

use Tracktik\Model\Abstracts\ElectronicItem;
use Tracktik\Model\Interfaces\ExtraItem;

class Console extends ElectronicItem implements ExtraItem
{
     /**
     * @var array
     */
    private $listExtras;

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
}
