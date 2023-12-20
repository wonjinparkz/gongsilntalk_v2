<?php

namespace App\Helper;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class EncryptCastHelper implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        return ! is_null($value) ? decrypt($value) : null;
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return [$key => ! is_null($value) ? encrypt($value) : null];
    }
}
