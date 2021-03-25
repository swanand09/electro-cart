<?php
namespace Tracktik\Model\Interfaces;
use Tracktik\Model\Abstracts\ElectronicItem;

interface ExtraItem
{
    /**
     * @return array
     */
    public function getListExtras();
    
    public function setListExtras(ElectronicItem $extraItem);
}
