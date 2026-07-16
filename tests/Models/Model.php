<?php

namespace rarksule\Hashidable\Tests\Models;

use rarksule\Hashidable\Hashidable;
use Illuminate\Database\Eloquent\Model as LaravelModel;

class Model extends LaravelModel
{
    use Hashidable;
}
