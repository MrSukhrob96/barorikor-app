<?php

namespace App\DTO\Category;

class CreateCategoryDTO
{

    public string $name;
    public $icon;
    public string $description;
    public int $status;

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
