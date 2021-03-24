<?php
namespace App\Model;

abstract class ElectronicItem {
		
    /**
     * @var float
     */
    public $price;
    
    /**
     * @var string
     */
    private $type;
    public $wired;
    
    protected $extras;
    
    const ELECTRONIC_ITEM_TELEVISION = 'television';
    const ELECTRONIC_ITEM_CONSOLE = 'console';
    const ELECTRONIC_ITEM_MICROWAVE = 'microwave';
    
    public static $types = array(
        self::ELECTRONIC_ITEM_CONSOLE,
        self::ELECTRONIC_ITEM_MICROWAVE,
        self::ELECTRONIC_ITEM_TELEVISION
    );
    
    public function getPrice() {
        return $this->price;
    }
    
    public function getType() {
        return $this->type;
    }
    
    public function getWired() {
        return $this->wired;
    }
    
    public function setPrice($price) {
        $this->price = $price;
    }
    
    public function setType($type) {
        $this->type = $type;
    }
    
    public function setWired($wired) {
        $this->wired = $wired;
    }
    
    protected abstract function maxExtras();
    
    public function getExtras() {
        // TODO: Implement getExtras() method.
        return $this->extras;
    }
    public function setExtras($extras) {
        // TODO: Implement setExtras() method.
        $this->extras = $extras;
    }
}