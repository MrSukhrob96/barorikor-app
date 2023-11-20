<?php

namespace App\Enums;


enum Pagination: int
{
    case LARGE  = 100;
    case MEDIUM = 50;
    case SMALL  = 20;
}