<?php

namespace App\DTO\Category;

class UpdateCategoryDTO {

    public int $id;
    public string $name;
    public string $description;
    public int $status;

    public function __constructor(array $data) {

    }


    public function toArray(): array {
        return array(

        );
    }

}