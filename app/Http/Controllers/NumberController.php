<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class NumberController extends Controller
{
    public function classifyNumber(Request $request)
    {
        // Validate input
        $number = $request->query('number');

        if (!is_numeric($number)) {
            return response()->json([
                'number' => 'alphabet',
                'error' => true
            ], 400);
        }

        $number = (int)$number;

        // Check if the number is prime
        $isPrime = $this->isPrime($number);

        // Check if the number is perfect
        $isPerfect = $this->isPerfect($number);

        // Check if the number is Armstrong
        $isArmstrong = $this->isArmstrong($number);

        // Check if the number is odd or even
        $parity = $number % 2 === 0 ? 'even' : 'odd';

        // Get fun fact from Numbers API
        $funFact = $this->getFunFact($number);

        // Prepare properties array
        $properties = [];
        if ($isArmstrong) {
            $properties[] = 'armstrong';
        }
        $properties[] = $parity;

        // Calculate digit sum
        $digitSum = array_sum(str_split((string)$number));

        // Return JSON response
        return response()->json([
            'number' => $number,
            'is_prime' => $isPrime,
            'is_perfect' => $isPerfect,
            'properties' => $properties,
            'digit_sum' => $digitSum,
            'fun_fact' => $funFact
        ], 200);
    }

    private function isPrime($number)
    {
        if ($number < 2) {
            return false;
        }
        for ($i = 2; $i <= sqrt($number); $i++) {
            if ($number % $i === 0) {
                return false;
            }
        }
        return true;
    }

    private function isPerfect($number)
    {
        if ($number < 2) {
            return false;
        }
        $sum = 1;
        for ($i = 2; $i <= sqrt($number); $i++) {
            if ($number % $i === 0) {
                $sum += $i;
                if ($i !== $number / $i) {
                    $sum += $number / $i;
                }
            }
        }
        return $sum === $number;
    }

    private function isArmstrong($number)
    {
        $digits = str_split((string)$number);
        $length = count($digits);
        $sum = 0;
        foreach ($digits as $digit) {
            $sum += pow((int)$digit, $length);
        }
        return $sum === $number;
    }

    private function getFunFact($number)
    {
        $client = new Client();
        $response = $client->get("http://numbersapi.com/{$number}/math");
        return $response->getBody()->getContents();
    }

}
