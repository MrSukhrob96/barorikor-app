<?php

namespace App\DTO\User;

class CreateUserDTO {

    public string $phoneNumber;

    public function __constructor(array $data) {

    }


    public function toArray(): array {
        return array(

        );
    }

}