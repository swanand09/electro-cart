<?php
declare(strict_types=1);
namespace  Tracktik\BusinessLogic;

use Tracktik\Model\Abstracts\ElectronicItem as Abstract_ElectronicItem;

class ElectronicItems
{
    
    /**
     * @var array
     */
    private $items = array();
    
    public function __construct(array $items)
    {
        $this->items = $items;
    }
    
    
    /**
     * Returns the items depending on the sorting type requested
     * @param $type
     * @return array
     */
    public function getSortedItems($type):array
    {
        $sorted = array();
        foreach ($this->items as $item) {
            $sorted[(call_user_func([$item, 'get' . ucfirst($type)]) * 100)] = $item;
        }
        
        ksort($sorted, SORT_NUMERIC);
        return $sorted;
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
