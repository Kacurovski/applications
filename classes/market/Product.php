<?php

namespace classes\market;

abstract class Product
{
    public string $name;
    public int $price;
    public bool $sellingByKg;

    public function __construct($name, $price, $sellingByKg)
    {
        $this->name = strtolower($name);
        $this->price = $price;
        $this->sellingByKg = $sellingByKg;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getName(){
        return $this->name;
    }
}

?>