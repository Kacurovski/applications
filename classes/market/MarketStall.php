<?php

namespace classes\market;

class MarketStall {
    public array $products = [];

    public function __construct(array $productsArray) {
        foreach ($productsArray as $name => $product) {
            if ($product instanceof Product) {
                $this->products[strtolower($name)] = $product;
            }
        }
    }

    public function addProductToMarket($name, $product) {
        if ($product instanceof Product) {
            $this->products[$name] = $product;
        }
    }

    public function getItem($item, $amount)
    {   
        $item = strtolower($item);
        if(!key_exists($item, $this->products)){
            return false;
        } else {                      
            return ['amount' => $amount, 'item' => $this->products[$item]];
        }
    }
}

?>