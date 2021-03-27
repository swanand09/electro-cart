<?php
namespace Tracktik\Model\Interfaces;

use Tracktik\Model\Abstracts\ElectronicItem;

interface ExtraItem
{
    /**
     * @return array
     */
    public function getListExtras();
    
    public function setListExtras(array $extraItems);

    public function addListExtras(ElectronicItem $extraItem);

    public function setTotalPrice(float $totalPrice);

    /**
     * @return float
     */
    public function getTotalPrice();
}
