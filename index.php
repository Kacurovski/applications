<?php


// Roman Numerals array
$romanNumerals = array(
    "M" => 1000,
    "CM" => 900,
    "D" => 500,
    "CD" => 400,
    "C" => 100,
    "XC" => 90,
    "L" => 50,
    "XL" => 40,
    "X" => 10,
    "IX" => 9,
    "V" => 5,
    "IV" => 4,
    "I" => 1
);


$romanNumeralsExtend = array(
    "M*" => 1000000,
    "C*M*" => 900000,
    "D*" => 500000,
    "C*D*" => 400000,
    "C*" => 100000,
    "X*C*" => 90000,
    "L*" => 50000,
    "X*L*" => 40000,
    "X" => 10000,
    "MX*" => 9000,
    "V*" => 5000,
    "MV*" => 4000,
    "M" => 1000,
    "CM" => 900,
    "D" => 500,
    "CD" => 400,
    "C" => 100,
    "XC" => 90,
    "L" => 50,
    "XL" => 40,
    "X" => 10,
    "IX" => 9,
    "V" => 5,
    "IV" => 4,
    "I" => 1
);
// Part01

echo "Part01: <br> <br>";

// Decimal to Binary
function decimalToBinary($decimalNumber)
{
    if ($decimalNumber == 0) {
        return "0";
    }

    $binaryNumber = "";

    while ($decimalNumber > 0) {
        $remainder = $decimalNumber % 2;
        $binaryNumber = $remainder . $binaryNumber;
        $decimalNumber = (int) ($decimalNumber / 2);
    }

    return $binaryNumber;
}

//Decimal number to Roman number
function decimalToRoman($decimalNumber, $romanNumerals)
{
    if ($decimalNumber > 3999) {
        return "Error: Number exceeds maximum limit.";
    }

    $romanNumber = "";

    foreach ($romanNumerals as $romanSymbol => $value) {
        while ($decimalNumber >= $value) {
            $romanNumber .= $romanSymbol;
            $decimalNumber -= $value;
        }
    }

    return $romanNumber;
}

$decimalNumber = 25;


echo "Decimal Number: $decimalNumber" . '<br>';
echo "Binary Number: " . decimalToBinary($decimalNumber) . '<br>';
echo "Roman Number: " . decimalToRoman($decimalNumber, $romanNumerals) . '<br>';

echo "<hr>";

// Part02

echo "Part02: <br> <br>";

//Binary number to decimal number
function binaryToDecimal($binaryNumber)
{
    $decimalNumber = 0;
    $binaryLength = strlen($binaryNumber);

    for ($i = 0; $i < $binaryLength; $i++) {
        $decimalNumber += intval($binaryNumber[$i]) * pow(2, ($binaryLength - 1 - $i));
    }

    return $decimalNumber;
}

//Roman number to decimal number
function romanToDecimal($romanNumber, $romanNumerals)
{
    $decimalNumber = 0;

    foreach ($romanNumerals as $romanSymbol => $value) {
        while (strpos($romanNumber, $romanSymbol) === 0) {
            $decimalNumber += $value;
            $romanNumber = substr($romanNumber, strlen($romanSymbol));
        }
    }

    return $decimalNumber;
}



$binaryNumber = "101010";
echo "Binary Number: $binaryNumber" . "<br>";
echo "Decimal Number: " . binaryToDecimal($binaryNumber) . "<br>";

echo "<br>";

$romanNumber = "XLII";
echo "Roman Number: $romanNumber" . "<br>";
echo "Decimal Number: " . romanToDecimal($romanNumber, $romanNumerals) . "<br>";

echo "<br>";
echo "<hr>";

// Part03

echo "Part03: <br> <br>";

function checkNumberType($number)
{
    $startsWithSign = preg_match('/^[+-]/', $number);
    $isBinary = preg_match('/^[01]+$/', $number);
    $isRoman = preg_match('/^(M{0,3})(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$/', $number);
    $isDecimal = preg_match('/^(?!0[0-9])[-+]?[0-9]+$/', $number);
    $isDecimalWithSign = $startsWithSign && $isDecimal;
    $isDecimalWithZeroAndSign = preg_match('/^[+-]0[0-9]+$/', $number);

    if ($isBinary) {
        return "Binary";
    } elseif ($isRoman) {
        return "Roman";
    } elseif ($isDecimalWithZeroAndSign) {
        return "Error: Decimal number starts with zero and has a sign.";
    } elseif ($isDecimalWithSign) {
        return "Decimal";
    } elseif ($isDecimal) {
        return "Decimal";
    } else {
        return "Unknown";
    }
}

$numbers = array(
    "+10",
    "-100",
    "+101",
    "-1010",
    "100",
    "545",
    "MCMXCIV",
    "IX",
    "01",
    "+0123"
);

foreach ($numbers as $number) {
    echo "Number: $number | Type: " . checkNumberType($number) . "<br>";
}

echo "<hr>";

function convertNumber($number, $romanNumerals)
{
    $numberType = checkNumberType($number);
    $conversionResult = array();

    switch ($numberType) {
        case "Decimal":
            $conversionResult["Binary"] = decimalToBinary($number);
            $conversionResult["Roman"] = decimalToRoman($number, $romanNumerals);
            break;
        case "Binary":
            $conversionResult["Decimal"] = binaryToDecimal($number);
            $conversionResult["Roman"] = decimalToRoman(binaryToDecimal($number), $romanNumerals);
            break;
        case "Roman":
            $conversionResult["Decimal"] = romanToDecimal($number, $romanNumerals);
            $conversionResult["Binary"] = decimalToBinary(romanToDecimal($number, $romanNumerals));
            break;
        default:
            $conversionResult["Error"] = "Invalid number type.";
            break;
    }

    return $conversionResult;
}

$number = "35";
$conversions = convertNumber($number, $romanNumerals);

echo "Number: $number<br>";
foreach ($conversions as $type => $value) {
    echo "$type: $value<br>";
}

echo "<hr>";

// Increase the limit for the Roman numbers converter
function decimalToRomanExtended($decimalNumber, $romanNumeralsExtend)
{
    if ($decimalNumber > 3999999) {
        return "Error: Number exceeds maximum limit.";
    }

    $romanNumber = "";

    foreach ($romanNumeralsExtend as $romanSymbol => $value) {
        while ($decimalNumber >= $value) {
            $romanNumber .= $romanSymbol;
            $decimalNumber -= $value;
        }
    }

    return $romanNumber;
}


echo decimalToRomanExtended(450000, $romanNumeralsExtend);

echo "<hr>";

//Array with 10 numbers of all types
$numbers = array(
    25,               
    "1010",          
    "XLII",           
    16,              
    "100110",         
    "IX",            
    8,                
    "1111",           
    "XIV",           
    42               
);

// Iterate through the array and print each number in all three numbering systems
foreach ($numbers as $number) {
    echo "Number: $number | Type: " . checkNumberType($number) . "<br>";

    if (checkNumberType($number) == 'Decimal') {
        echo "Binary Number: " . decimalToBinary($number) . "<br>";
        echo "Roman Number: " . decimalToRoman($number, $romanNumerals) . "<br>";
    } elseif (checkNumberType($number) == 'Binary') {
        echo "Decimal Number: " . binaryToDecimal($number) . "<br>";
        echo "Roman Number: " . decimalToRoman(binaryToDecimal($number), $romanNumerals) . "<br>";
    } elseif (checkNumberType($number) == 'Roman') {
        echo "Decimal Number: " . romanToDecimal($number, $romanNumerals) . "<br>";
        echo "Binary Number: " . decimalToBinary(romanToDecimal($number, $romanNumerals)) . "<br>";
    }

    echo "<br>";
}

?>
