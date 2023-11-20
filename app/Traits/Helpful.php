<?php

namespace App\Traits;

trait Helpful
{
    /**
     * Method generateCode
     * 
     * @param int $length
     * @return int
     */
    public function generateCode(int $length = 5): int
    {
        $min = 10 ** ($length - 1);
        $max = 10 ** $length - 1;

        return rand($min, $max);
    }


    /**
     * Method getPhoneNumber
     * 
     * @param string $phoneNumber
     * @return string
     */
    public function getPhoneNumber(string $phoneNumber): string
    {
        return ltrim(str_replace(" ", "", $phoneNumber), "+");
    }
}
