<?php

namespace App\DTO\City;

class CreateCityDTO
{
    public string $name;
    public string $status;

    public function __constructor(array $data)
    {
    }


    /**
     * Method toArray
     * 
     * @return array<string,mixed>
     */
    public function toArray(): array
    {
        return array(

        );
    }
}
