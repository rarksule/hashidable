<?php

namespace rarksule\Hashidable\Tests\Models;

use rarksule\Hashidable\Hashidable;
use Illuminate\Database\Eloquent\Model as LaravelModel;
use rarksule\Hashidable\HashidableConfigInterface;

class ModelConfig extends LaravelModel implements HashidableConfigInterface
{
    use Hashidable;

    protected $table = 'models';

    public function hashidableConfig()
    {
        return array_merge(config('hashidable'), ['length' => 64]);
    }
}
