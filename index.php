<?php

require_once('classes/market/MarketStall.php');
require_once('classes/market/Product.php');
require_once('classes/products/Kiwi.php');
require_once('classes/products/Banana.php');
require_once('classes/products/Cherry.php');
require_once('classes/products/Lemon.php');
require_once('classes/products/Orange.php');
require_once('classes/products/Raspberry.php');
require_once('classes/market/Cart.php');

use classes\products\Kiwi as Kiwi;
use classes\products\Banana as Banana;
use classes\products\Cherry as Cherry;
use classes\products\Lemon as Lemon;
use classes\products\Orange as Orange;
use classes\products\Raspberry as Raspberry;
use classes\market\MarketStall as MarketStall;
use classes\market\Cart as Cart;

$kiwi = new Kiwi('kiwi', 50, true);
$banana = new Banana('banana', 70, false);
$cherry = new Cherry('cherry', 20, true);
$lemon = new Lemon('lemon', 30, false);
$orange = new Orange('orange', 40, true);
$raspberry = new Raspberry('raspberry', 80, false);

$market1 = new MarketStall(['kiwi' => $kiwi, 'banana' => $banana]);
$market1->addProductToMarket('raspberry', $raspberry);
// var_dump($market1);

$market2 = new MarketStall(['cherry' => $cherry, 'lemon' => $banana]);
$market2->addProductToMarket('orange', $orange);
// var_dump($market2);

// $market1->getItem('kiwi', 5);
// print_r($market1->getItem('kiwi', 5));

echo "<hr>";

$cart = new Cart();
$cart->addToCart($market1->getItem('Kiwi', 3));
$cart->addToCart($market1->getItem('banana', 6));
$cart->addToCart($market1->getItem('raspberry', 7));
$cart->addToCart($market2->getItem('lemon', 12));
$cart->addToCart($market2->getItem('cherry', 9));
$cart->addToCart($market2->getItem('orange', 5));

echo $cart->printReceipt();

?>