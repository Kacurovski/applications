<?php

//exercise 01


$name = 'Kathrin';

if($name === 'Kathrin'){
    echo "Hello $name";
} else {
    echo "Nice name";
}


$br = "<br><br>";
$hr = "<hr>";
echo $br;


$rating = 7;

if($rating >= 1 && $rating <= 10){
    echo "Thank you for rating";
} else {
    echo "Invalid rating, only numbers between 1 and 10";
}


echo $br;
echo $hr;


//exercise 02

if(date('H') < 12) {
    echo "Good morning $name";
} elseif (date('H') < 19){
    echo "Good afternoon $name";
} else {
    echo "Good evening $name";
}

echo $br;


$rated = true;


if (is_int($rating) && $rating >= 1 && $rating <= 10) {
    if($rated === true){
        echo "You already voted";
    } else {
        echo "Thanks for voting";
    }
} else {
    echo "Invalid rating, only numbers between 1 and 10";
}


echo $br;
echo $hr;


//exercise03


$voters = [
    'Emily' => [true, 4],
    'Liam' => [false, 6],
    'Sophia' => [true, 5],
    'Noah' => [true, 5],
    'Olivia' => [true, 3],
    'Ethan' => [false, 7],
    'Ava' => [false, 18],
    'Mason' => [true, 5],
    'Isabella' => [false, 9],
    'Aiden' => [true, 10]
];

foreach ($voters as $voter => $voterRating) {
    if(date('H') < 12){
        echo "Good morning $voter";
    } elseif(date('H') < 19){
        echo "Good afternoon $voter";
    } else {
        echo "Good evening $voter";
    }

    echo $br;

    if($voterRating[1] >= 1 && $voterRating[1] <= 10){
        if($voterRating[0] == "true"){
            echo "You already voted with $voterRating[1]";
        } else {
            echo "Thanks for voting with $voterRating[1]";
        }
    } else {
        echo "Invalid rating, only numbers between 1 and 10.";
    }
    
    echo $br;
}






?>