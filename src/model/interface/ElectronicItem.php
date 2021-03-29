<?php
namespace Tracktik\Model\Interfaces;

interface ElectronicItem
{
    public function getPrice(): float;
    public function setPrice(float $price);
    public function getType(): string;
    public function setType(string $type);
    public function getWired(): string;
    public function setWired(string $wired);
    public function getExtras(): int;
    public function setExtras(int $extras);
}
