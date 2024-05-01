<?php

function inputValidation(array $inputs){

    foreach($inputs as $input){
        if(empty($input) || !isset($input)){
            return false;
        }
    }
    return true;
}
