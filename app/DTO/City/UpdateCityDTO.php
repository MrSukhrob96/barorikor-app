<?php

namespace App\DTO\City;

class UpdateCityDTO {

    public int $id;
    public string $name;
    public string $status;

    public function __constructor(array $data) {

    }


    public function toArray(): array {
        return array(

        );
    }

}