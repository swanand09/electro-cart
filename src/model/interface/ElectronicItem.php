<?php
namespace App\Model\Interfaces;

interface ElectronicItem
{
    public function getPrice();
    public function getType();
    public function getWired();
    public function setPrice($price);
    public function setType($type);
    public function setWired($wired);
    public function getExtras();
    public function setExtras($extras);
}
