<?php
namespace Tracktik\Model\Interfaces;

interface ElectronicItem
{

    public function getPrice();
    public function setPrice($price);
    public function getType();
    public function setType($type);
    public function getWired();
    public function setWired($wired);
    public function getExtras();
    public function setExtras($extras);
}
