<?php

require_once ('classes/Furniture.php');
require_once ('classes/printable.php');
require_once ('classes/sofa.php');
require_once ('classes/bench.php');
require_once ('classes/chair.php');


//part01

$furniture = new Furniture('200', '100', '300');
$furniture->setIsForSeating(true);
$furniture->setIsForSleeping(false);
echo "Furniture Area: {$furniture->area()} (Width[{$furniture->getWidth()}] * Lenght[{$furniture->getLength()}]) <br>";
echo "Furniture Volume: {$furniture->volume()} (Area[{$furniture->area()}] * Height[{$furniture->getHeight()}]) <br>";

echo '<hr>';

//part02

$sofa = new Sofa('300', '400', '150');
$sofa->setIsForSeating(true);
$sofa->setSeats(4);
$sofa->setArmrests(2);
echo "Sofa Area: " . $sofa->area() . '<br>';
echo "Sofa Volume: " . $sofa->volume() . '<br>';
echo $sofa->area_opened();

echo '<br>';
//setting is for sleeping and lenght opened:

$sofa->setIsForSleeping(true);
$sofa->setLegthOpened('500');
echo $sofa->area_opened();

echo '<hr>';

//part03
$sofa->sneakpeek();
echo '<br>';
$sofa->print();
echo '<br>';
$sofa->fullinfo();

echo '<br><br>';

$bench = new Bench('200', '100', '350');
$bench->sneakpeek();
echo '<br>';
$bench->print();
echo '<br>';
$bench->fullinfo();

echo '<br><br>';

$chair = new Chair('100', '500', '650');
$chair->setIsForSleeping(true);
$chair->sneakpeek();
echo '<br>';
$chair->print();    
echo '<br>';
$chair->fullinfo();


?>