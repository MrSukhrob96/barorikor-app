<?php

namespace App\Core;

abstract class CoreDTO
{
    /**
     * Method toArray
     * 
     * @return array<string,mixed>
     */
    public abstract function toArray(): array;
}
