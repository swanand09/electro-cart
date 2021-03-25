<?php
declare(strict_types=1);
namespace Tracktik\Model\Abstracts;

use Tracktik\Model\Interfaces\ElectronicItem as Interface_ElectronicItem;

abstract class ElectronicItem implements Interface_ElectronicItem
{
        
    /**
     * @var float
     */
    private $price;
    
    /**
     * @var string
     */
    private $type;
    private $wired;
    
    protected $extras;
    
    const ELECTRONIC_ITEM_TELEVISION = 'television';
    const ELECTRONIC_ITEM_CONSOLE = 'console';
    const ELECTRONIC_ITEM_MICROWAVE = 'microwave';
    
    public static $types = array(
        self::ELECTRONIC_ITEM_CONSOLE,
        self::ELECTRONIC_ITEM_MICROWAVE,
        self::ELECTRONIC_ITEM_TELEVISION
    );
    
    public function getPrice(): float
    {
        return $this->price;
    }
    public function setPrice($price)
    {
        $this->price = $price;
    }
    
    public function getType():string
    {
        return $this->type;
    }
    public function setType($type)
    {
        $this->type = $type;
    }

    public function getWired()
    {
        return $this->wired;
    }
    public function setWired($wired)
    {
        $this->wired = $wired;
    }
    
    public function getExtras():int
    {
        return $this->extras;
    }
    public function setExtras($extras)
    {
        $this->extras = $extras;
    }

    abstract protected function maxExtras();
}