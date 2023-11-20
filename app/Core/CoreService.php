<?php

namespace App\Core;

use App\Traits\AuthTrait;
use App\Traits\FileUploader;
use App\Traits\Helpful;

abstract class CoreService
{
    use AuthTrait, Helpful, FileUploader;
}
