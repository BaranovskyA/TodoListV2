<?php

namespace App\Casts;

use App\Status;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Psy\Exception\TypeErrorException;

class StatusCast implements CastsAttributes
{
    public function get($model, $key, $value, $attributes)
    {
        return $this->getStatus($value);
    }

    public function set($model, $key, $value, $attributes)
    {
        $this->getStatus($value);
        return $value;
    }

    protected function getStatus($index) {
        $list = Status::list();
        if(!isset($list[$index]))
            throw new TypeErrorException("Status index[$index] not defined.");

        return $list[$index];
    }
}
