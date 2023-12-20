<?php

namespace App\Helper;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Facades\Log;

class DateCastHelper implements CastsAttributes
{

    public function get($model, $key, $value, $attributes)
    {
        return [$key => ! is_null($value) ? Carbon::parse($value)->shiftTimezone('Asia/Seoul') : null];
    }

    public function set($model, $key, $value, $attributes)
    {
        return [$key => ! is_null($value) ? Carbon::createFromFormat('Y-m-d h:i:s', $value) : null];
    }
}
