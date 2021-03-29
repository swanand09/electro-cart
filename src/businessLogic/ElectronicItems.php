<?php declare(strict_types=1);
namespace  Tracktik\BusinessLogic;

use Tracktik\Model\Abstracts\ElectronicItem as Abstract_ElectronicItem;

final class ElectronicItems
{
    
    /**
     * @var array
     */
    private array $items = array();
    
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
        $count = 1;
        foreach ($this->items as $item) {
            $sorted[(call_user_func([$item, 'get' . ucfirst($type)]) * 100)+$count] = $item;
            $count++;
        }
        
        ksort($sorted, SORT_NUMERIC);
        return $sorted;
    }
    
    /**
     * get Item from list of items by type(console,television,microwave)
     * @param string $type
     * @return array
     */
    public function getItemsByType($type)
    {
        if (in_array($type, Abstract_ElectronicItem::$types)) {
            $callback = function ($item) use ($type) {
                return $item->getType() == $type;
            };
            
            return array_values(array_filter($this->items, $callback));
        }
        
        return [];
    }
}
