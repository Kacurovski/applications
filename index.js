// Exercise 01
function isEven(number) {
    if (number % 2 === 0) {
        console.log(`The number ${number} is even`);
    } else {
        console.log(`The number ${number} is not even`);
    }
}

isEven(12);

// Exercise 02
function isEvenAndDivisibleBy3(from, to) {
    for (let number = from; number <= to; number++) {
        if (number % 2 === 0 && number % 3 === 0) {
            console.log(number);
        }
    }
}

isEvenAndDivisibleBy3(10, 100);

// Exercise 03
function findSmallestAndLargestAndCheckPrime(number1, number2, number3) {
    let smallest = Math.min(number1, number2, number3);
    let largest = Math.max(number1, number2, number3);

    function isPrime(num) {
        if (num <= 1) {
            return false;
        }
        for (var i = 2; i <= Math.sqrt(num); i++) {
            if (num % i === 0) {
                return false;
            }
        }
        return true;
    }

    let smallestIsPrime = isPrime(smallest);
    let largestIsPrime = isPrime(largest);

    let messages = [];
    messages.push(`Smallest - ${smallest}, Largest - ${largest}`);
    if (smallestIsPrime) {
        messages.push(`The smallest number ${smallest} is prime`);
    } else {
        messages.push(`The smallest number ${smallest} is not prime`);
    }
    if (largestIsPrime) {
        messages.push(`The largest number ${largest} is prime`);
    } else {
        messages.push(`The largest number ${largest} is not prime`);
    }

    console.log(messages.join("\n"));
}

findSmallestAndLargestAndCheckPrime(13, 15, 20);