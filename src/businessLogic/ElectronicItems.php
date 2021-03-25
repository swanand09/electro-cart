<?php
namespace  Tracktik\BusinessLogic;

use Tracktik\Model\Abstracts\ElectronicItem as Abstract_ElectronicItem;

class ElectronicItems
{
    private $items = array();
    
    public function __construct(array $items)
    {
        $this->items = $items;
    }
    
    /**
     * Returns the items depending on the sorting type requested
     * @return array
     */
    public function getSortedItems($type)
    {
        $sorted = array();
        foreach ($this->items as $item) {
            $sorted[(call_user_func([$item, 'get' . ucfirst($type)]) * 100)] = $item;
        }
        
        return ksort($sorted, SORT_NUMERIC);
    }
    
    /**
     * @param string $type
     * @return array
     */
    public function getItemsByType($type)
    {
        if (in_array($type, Abstract_ElectronicItem::$types)) {
            $callback = function ($item) use ($type) {
                return $item->getType() == $type;
            };
            
            $items = array_filter($this->items, $callback);
        }
        
        return false;
    }
}
