<?php
class Television extends ElectronicItem
{
    public function __construct()
    {
    }
    
    protected function maxExtras()
    {
        // TODO: Implement maxExtras() method.
        return count($this->getExtras());
    }
}
