<?php

namespace classes\market;

class Cart 
{
    private array $cartItems = [];

    public function addToCart($item)
    {
        if ($item !== false)
        {
            $this->cartItems[] = $item;
        } else{
            echo "We dont have this item in the market <br>";
        }       
    }

    public function printReceipt()
    {
        if(empty($this->cartItems)){
            return "your cart is empty";
        } else {
            $totalPrice = 0;
            foreach($this->cartItems as $cartItem){
                $item = $cartItem['item'];
                $itemName = $item->getName();
                $amount = $cartItem['amount'];
                $totalItemPrice = $amount * $item->getPrice();
                $totalPrice += $totalItemPrice;
                if($item->sellingByKg){
                    $type = "kgs";
                } else {
                    $type = "gunny sacks";
                }
                echo "$itemName | $amount $type | total = $totalItemPrice <br>";
            }
            echo "Full price amount: $totalPrice";
        }
    }
}